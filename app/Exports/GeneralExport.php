<?php

namespace App\Exports;

use App\Models\Activity;
use App\Models\Postulation;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class GeneralExport implements FromView
{
    private $activity; 
    private $year; 
    public function __construct(Activity $activity, int $year) {
        $this->activity = $activity;
        $this->year = $year;
    }

    /**
     * @return \Illuminate\Support\View
     */
    public function view(): View
    {
        $activities_approved = Postulation::join('postulation_state', 'postulation_state.postulation_id', '=', 'postulations.id')
            ->selectRaw('SUM(student_members) as students, SUM(graduated_members) as graduates, SUM(budget) as budget')
            ->where('activity_id', $this->activity->id)
            ->where('postulation_state.state_id', 5)
            ->whereYear('postulations.created_at', $this->year)
            ->first();

        $activities_disapproved = Postulation::join('postulation_state', 'postulation_state.postulation_id', '=', 'postulations.id')
            ->selectRaw('SUM(student_members) as students, SUM(graduated_members) as graduates')
            ->where('activity_id', $this->activity->id)
            ->where('postulation_state.state_id', 6)
            ->whereYear('postulations.created_at', $this->year)
            ->first();

        return view('admin.reports.general', [
            'activity' => $this->activity,
            'activities_approved' => $activities_approved,
            'activities_disapproved' => $activities_disapproved,
        ]);
    }
}
