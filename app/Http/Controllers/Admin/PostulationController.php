<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Postulation;
use App\Models\Subsidy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostulationController extends Controller
{
    public function all_index(Subsidy $subsidy) {
        return view('admin.postulations.all_index', compact('subsidy'));
    }
    public function all_data(Request $request) {
        return DB::select('SELECT postulations.id, postulations.name from postulations
        join announcements on announcement_id = announcements.id
        join subsidies on subsidy_id = subsidies.id
        where subsidies.id = '. $request->id);
    }
}
