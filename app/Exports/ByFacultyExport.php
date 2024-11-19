<?php

namespace App\Exports;

use App\Models\Activity;
use App\Models\Postulation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ByFacultyExport implements FromView
{
    private $year;
    private $activity;
    public function __construct(int $year, Activity $activity)
    {
        $this->year = $year;
        $this->activity = $activity;
    }

    public function view(): View
    {
        $records = Postulation::selectRaw('SUM(student_members) as total_students, SUM(graduated_members) as total_graduates, SUM(budget) as total_budget, faculties.name as faculty')
            ->join('students', 'student_id', '=', 'students.id')
            ->join('schools', 'schools.id', '=', 'students.school_id')
            ->join('faculties', 'faculties.id', '=', 'faculty_id')
            ->join('postulation_state', 'postulation_state.postulation_id', '=', 'postulations.id')
            ->where('state_id', 5)
            ->where('activity_id', $this->activity->id)
            ->groupBy('faculties.id', 'faculties.name')
            ->whereYear('postulations.created_at', $this->year)
            ->get();

        return view('admin.reports.by-faculty', [
            'records' => $records, 
            'year' => $this->year, 
            'activity' => $this->activity
        ]);
    }
}
