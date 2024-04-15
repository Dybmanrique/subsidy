<?php

namespace App\Livewire\Postulation;

use App\Models\Postulation;
use App\Models\Subsidy;
use Livewire\Component;

class SubventionsList extends Component
{
    public $subsidies;

    public function mount(){
        $this->subsidies = Subsidy::where('status','activo')->get();
    }

    public function postulate($subsidy_id, $subsidy_name){
        $subsidy = Subsidy::find($subsidy_id);
        $announcement = $subsidy->announcement()->latest()->first();
        
        $postulation = Postulation::create([
            'name' => $subsidy_name,
            'student_id' => auth()->user()->student->id,
            'announcement_id' => $announcement->id,
        ]);

        redirect()->route('postulations.postulate', $postulation);
    }

    public function render()
    {
        return view('livewire.postulation.subventions-list');
    }
}
