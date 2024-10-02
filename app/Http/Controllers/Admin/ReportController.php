<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ByFacultyExport;
use App\Exports\GeneralExport;
use App\Exports\HistoricalExport;
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
        $request->validate([
            'activity_id' => 'required|integer',
            'year' => 'required|digits:4|integer|min:1900',
        ]);
        $activity = Activity::findOrFail($request->activity_id);
        return Excel::download(new GeneralExport($activity, $request->year), 'Reporte General.xlsx');
    }

    public function historical(Request $request){
        $request->validate([
            'year' => 'required|digits:4|integer|min:1900',
        ]);
        return Excel::download(new HistoricalExport($request->year), 'Reporte Historico.xlsx');
    }
    public function by_faculty(Request $request){
        $request->validate([
            'activity_id' => 'required|integer',
            'year' => 'required|digits:4|integer|min:1900',
        ]);
        $activity = Activity::findOrFail($request->activity_id);
        return Excel::download(new ByFacultyExport($request->year, $activity), 'Reporte por Facultades.xlsx');
    }
}
