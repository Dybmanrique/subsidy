<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Postulation;
use App\Models\Subsidy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostulationController extends Controller
{
    public function all_index(Subsidy $subsidy)
    {
        return view('admin.postulations.all_index', compact('subsidy'));
    }

    public function all_data(Subsidy $subsidy)
    {
        return DB::select("SELECT postulations.id, postulations.name as postulation, postulations.status,
            announcements.name as announcement, 
            users.name, users.last_name, users.email, schools.name as school, faculties.name as faculty
            from postulations
            join students on student_id = students.id
            join announcements on announcement_id = announcements.id
            join users on user_id = users.id
            join schools on school_id = schools.id
            join faculties on faculty_id = faculties.id
            where announcements.subsidy_id = $subsidy->id");
    }

    public function view_postulation($postulation_id)
    {
        $postulation = Postulation::findOrFail($postulation_id);
        
        $previous_id = DB::scalar("SELECT postulations.id from postulations
        join announcements on announcement_id = announcements.id
        where announcements.subsidy_id = :subsidy_id and postulations.id < :postulation_id order by id desc limit 1", 
        ['subsidy_id' => $postulation->announcement->subsidy->id, 'postulation_id' => $postulation->id]);
        
        $next_id = DB::scalar("SELECT postulations.id from postulations
        join announcements on announcement_id = announcements.id
        where announcements.subsidy_id = :subsidy_id and postulations.id > :postulation_id order by id asc limit 1", 
        ['subsidy_id' => $postulation->announcement->subsidy->id, 'postulation_id' => $postulation->id]);

        return view('admin.postulations.view_postulation', compact('postulation','previous_id','next_id'));
    }
}
