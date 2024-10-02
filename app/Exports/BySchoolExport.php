<?php

namespace App\Exports;

use App\Models\Activity;
use App\Models\Faculty;
use App\Models\Postulation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BySchoolExport implements FromView
{
    private $year;
    private $activity;
    private $faculty;
    private $total_students=0;
    private $total_budget=0;

    public function __construct(int $year, Activity $activity, Faculty $faculty)
    {
        $this->year = $year;
        $this->activity = $activity;
        $this->faculty = $faculty;
    }

    public function view(): View
    {
        $records = Postulation::selectRaw('SUM(student_members) as total_students, SUM(graduated_members) as total_graduates, SUM(budget) as total_budget, schools.name as school')
            ->join('students', 'student_id', '=', 'students.id')
            ->join('schools', 'schools.id', '=', 'students.school_id')
            ->join('faculties', 'faculties.id', '=', 'faculty_id')
            ->join('postulation_state', 'postulation_state.postulation_id', '=', 'postulations.id')
            ->where('state_id', 5)
            ->where('activity_id', $this->activity->id)
            ->where('faculties.id', $this->faculty->id)
            ->groupBy('schools.id')
            ->whereYear('postulations.created_at', $this->year)
            ->get();

        

        foreach ($records as $record) {
            $this->total_students += ($record->total_students + $record->total_graduates);
            $this->total_budget += $record->total_budget;
        }

        return view('admin.reports.by-school', [
            'records' => $records, 
            'year' => $this->year, 
            'activity' => $this->activity,
            'faculty' => $this->faculty,
            'total_students' => $this->total_students,
            'total_budget' => $this->total_budget,
        ]);
    }
}
