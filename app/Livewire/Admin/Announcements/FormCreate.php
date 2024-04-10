<?php

namespace App\Livewire\Admin\Announcements;

use App\Models\Announcement;
use App\Models\Subsidy;
use App\Models\Vicerrector;
use Livewire\Component;

class FormCreate extends Component
{
    public $vicerrectors, $subsidies;

    public $name, $start, $end, $subsidy_id, $vicerrector_id;

    public function mount()
    {
        $this->vicerrectors = Vicerrector::all();
        $this->subsidies = Subsidy::all();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
            'subsidy_id' => 'required|numeric',
            'vicerrector_id' => 'required|numeric',
        ]);
        
        try {
            Announcement::create([
                "name" => $this->name,
                "start" => $this->start,
                "end" => $this->end,
                "subsidy_id" => $this->subsidy_id,
                "vicerrector_id" => $this->vicerrector_id,
            ]);
            $this->reset('name', 'start', 'end', 'subsidy_id', 'vicerrector_id');
            $this->dispatch('message', code: '200', content: 'Se ha creado');
        } catch (\Exception $ex) {
            $this->dispatch('message', code: '500', content: 'No se pudo crear');
        }
    }

    public function render()
    {
        return view('livewire.admin.announcements.form-create');
    }
}
