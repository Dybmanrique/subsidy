<?php

namespace App\Exports;

use App\Models\Activity;
use App\Models\Postulation;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HistoricalExport implements FromView
{
    private $year;
    public function __construct($year) {
        $this->year = $year;
    }

    /**
     * @return \Illuminate\Support\View
     */
    public function view(): View
    {
        $records = Postulation::join('activities', 'postulations.activity_id', '=', 'activities.id')
        ->join('postulation_state', 'postulation_state.postulation_id', '=', 'postulations.id')
        ->selectRaw('SUM(student_members) as total_students, SUM(graduated_members) as total_graduates, SUM(budget) as total_budget, activities.name as activity')
        ->where('state_id',5)
        ->groupBy('postulations.activity_id', 'activities.name')
        ->whereYear('postulations.created_at', $this->year)
        ->get();

        return view('admin.reports.historical', ['records' => $records, 'year' => $this->year]);
    }
}
