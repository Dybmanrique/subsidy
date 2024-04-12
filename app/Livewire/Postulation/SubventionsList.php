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

    public function postulate($subsidy_id){
        $subsidy = Subsidy::find($subsidy_id);
        $announcement = $subsidy->announcement()->latest()->first();
        
        Postulation::create([
            'student_id' => auth()->user()->student->id,
            'announcement_id' => $announcement->id,
        ]);

        $this->dispatch('message', code: '200', content: 'Usted ha postulado correctamente, suba sus archivos');
    }

    public function render()
    {
        return view('livewire.postulation.subventions-list');
    }
}
