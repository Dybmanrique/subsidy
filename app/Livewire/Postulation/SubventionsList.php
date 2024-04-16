<?php

namespace App\Livewire\Postulation;

use App\Models\Postulation;
use App\Models\Subsidy;
use Livewire\Component;
use Illuminate\Support\Str;

class SubventionsList extends Component
{
    public $subsidies;
    public $model_open = false;
    public $activity_items = [];

    public $name, $activity_id, $adviser, $subsidy_id;

    public function mount(){
        $this->subsidies = Subsidy::where('status','activo')->get();
    }

    public function selectSubsidy($subsidy_id){
        $this->subsidy_id = $subsidy_id;
        $this->activity_items = Subsidy::find($subsidy_id)->activities()->where('status','activo')->get();
    }

    public function postulate(){
        $this->validate([
            'name' => 'required|string|max:255',
            'adviser' => 'nullable|string|max:255',
            'activity_id' => 'required|numeric',
        ]);

        $subsidy = Subsidy::find($this->subsidy_id);
        $announcement = $subsidy->announcement()->latest()->first();
        
        $postulation = Postulation::create([
            'name' => $this->name,
            'adviser' => $this->adviser,
            'uuid' => Str::uuid()->toString(),
            'activity_id' => $this->activity_id,
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
