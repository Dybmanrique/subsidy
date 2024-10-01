<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
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
        return DB::select("SELECT postulations.id, postulations.name as postulation, states.name as state,
            announcements.name as announcement, 
            users.name, users.last_name, users.email, schools.name as school, faculties.name as faculty
            from postulations
            join students on student_id = students.id
            join announcements on announcement_id = announcements.id
            join users on user_id = users.id
            join schools on school_id = schools.id
            join faculties on faculty_id = faculties.id
            join postulation_state on postulation_state.postulation_id = postulations.id
			join states on postulation_state.state_id = states.id
            where announcements.subsidy_id = :subsidy_id 
            and postulation_state.created_at =  (
				select max(postulation_state.created_at)
				from postulation_state
				where postulation_state.postulation_id = postulations.id
			) order by postulations.id desc", ['subsidy_id' => $subsidy->id]);
    }

    public function view_postulation($postulation_id)
    {
        $postulation = Postulation::findOrFail($postulation_id);

        $previous_id = DB::scalar(
            "SELECT postulations.id from postulations
        join announcements on announcement_id = announcements.id
        where announcements.subsidy_id = :subsidy_id and postulations.id < :postulation_id order by id desc limit 1",
            ['subsidy_id' => $postulation->announcement->subsidy->id, 'postulation_id' => $postulation->id]
        );

        $next_id = DB::scalar(
            "SELECT postulations.id from postulations
        join announcements on announcement_id = announcements.id
        where announcements.subsidy_id = :subsidy_id and postulations.id > :postulation_id order by id asc limit 1",
            ['subsidy_id' => $postulation->announcement->subsidy->id, 'postulation_id' => $postulation->id]
        );

        return view('admin.postulations.view_postulation', compact('postulation', 'previous_id', 'next_id'));
    }

    public function last_index(Subsidy $subsidy)
    {
        $last_announcement = Announcement::where('subsidy_id', $subsidy->id)->orderByDesc('id')->first();
        return view('admin.postulations.last_index', compact('subsidy', 'last_announcement'));
    }

    public function last_data(Subsidy $subsidy)
    {
        $last_announcement = Announcement::where('subsidy_id', $subsidy->id)->orderByDesc('id')->first();

        if ($last_announcement) {
            return DB::select(
                "SELECT postulations.id, postulations.name as postulation,
            states.name as state,
            users.name, users.last_name, users.email, schools.name as school, faculties.name as faculty
            from postulations
            join students on student_id = students.id
            join announcements on announcement_id = announcements.id
            join users on user_id = users.id
            join schools on school_id = schools.id
            join faculties on faculty_id = faculties.id
            join postulation_state on postulation_state.postulation_id = postulations.id
			join states on postulation_state.state_id = states.id
            where announcements.subsidy_id = :subsidy_id 
            and announcements.id = :announcement_id 
            and postulation_state.created_at =  (
				select max(postulation_state.created_at)
				from postulation_state
				where postulation_state.postulation_id = postulations.id
			) order by postulations.id desc",
                ['subsidy_id' => $subsidy->id, 'announcement_id' => $last_announcement->id]
            );
        } else {
            return [];
        }
    }
}
