<?php

namespace App\Http\Controllers\Admin;

use App\Exports\GeneralExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(){
        $activities = Activity::all();
        return view('admin.reports.index', compact('activities'));
    }

    public function general(Request $request){
        $activity = Activity::findOrFail($request->activity_id);
        return Excel::download(new GeneralExport($activity), 'Reporte General.xlsx');
    }
}
