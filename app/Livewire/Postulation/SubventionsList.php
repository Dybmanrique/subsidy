<?php

namespace App\Livewire\Postulation;

use App\Models\Announcement;
use App\Models\Postulation;
use App\Models\Subsidy;
use Livewire\Component;
use Illuminate\Support\Str;

class SubventionsList extends Component
{
    public $subsidies;
    public $announcements;
    public $model_open = false;
    public $activity_items = [];

    public $announcement_selected;
    public $name, $budget, $activity_id, $adviser, $subsidy_id;

    public function mount(){
        $this->subsidies = Subsidy::where('status','activo')->get();
        $currentDate = now()->toDateString(); // Obtiene la fecha actual en formato "YYYY-MM-DD"
        $this->announcements = Announcement::whereDate('start', '<=', $currentDate)
                                      ->whereDate('end', '>=', $currentDate)
                                      ->get();
    }

    public function selectAnnouncement($announcement_id){
        $this->announcement_selected = Announcement::find($announcement_id);
        $this->activity_items = Subsidy::find($this->announcement_selected->subsidy->id)->activities()->where('status','activo')->get();
    }

    public function postulate(){
        $this->validate([
            'name' => 'required|string|max:255',
            'budget' => 'required|numeric',
            'adviser' => 'nullable|string|max:255',
            'activity_id' => 'required|numeric',
        ]);

        if(auth()->user()->is_admin){
            //Restricción para el perfil de admin
            return;
        }

        $adviser = (trim($this->adviser) == "") ? null : $this->adviser;
        
        $postulation = Postulation::create([
            'name' => $this->name,
            'budget' => $this->budget,
            'adviser' => $adviser,
            'uuid' => Str::uuid()->toString(),
            'activity_id' => $this->activity_id,
            'student_id' => auth()->user()->student->id,
            'announcement_id' => $this->announcement_selected->id,
        ]);

        $postulation->states()->attach(1); //Asigne el primer estado por defecto

        redirect()->route('postulations.postulate', $postulation);
    }

    public function render()
    {
        return view('livewire.postulation.subventions-list');
    }
}
