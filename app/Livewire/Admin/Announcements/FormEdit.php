<?php

namespace App\Livewire\Admin\Announcements;

use App\Models\Subsidy;
use App\Models\Vicerrector;
use Livewire\Component;

class FormEdit extends Component
{
    public $announcement;
    public $vicerrectors, $subsidies;
    public $name, $start, $end, $description, $subsidy_id, $vicerrector_id;

    public function mount()
    {
        $this->vicerrectors = Vicerrector::all();
        $this->subsidies = Subsidy::all();
        $this->name = $this->announcement->name;
        $this->start = $this->announcement->start;
        $this->end = $this->announcement->end;
        $this->description = $this->announcement->description;
        $this->subsidy_id = $this->announcement->subsidy_id;
        $this->vicerrector_id = $this->announcement->vicerrector_id;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
            'description' => 'nullable|string',
            'subsidy_id' => 'required|numeric',
            'vicerrector_id' => 'required|numeric',
        ]);
        
        try {
            $this->announcement->update([
                "name" => $this->name,
                "start" => $this->start,
                "end" => $this->end,
                "description" => $this->description,
                "subsidy_id" => $this->subsidy_id,
                "vicerrector_id" => $this->vicerrector_id,
            ]);
            $this->dispatch('message', code: '200', content: 'Se ha editado');
        } catch (\Exception $ex) {
            $this->dispatch('message', code: '500', content: 'No se pudo editar');
        }
    }

    public function render()
    {
        return view('livewire.admin.announcements.form-edit');
    }
}
