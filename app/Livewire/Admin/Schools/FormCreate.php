<?php

namespace App\Livewire\Admin\Schools;

use App\Models\Faculty;
use App\Models\School;
use Livewire\Component;

class FormCreate extends Component
{
    public $faculties;

    public $name, $faculty_id;

    public function mount()
    {
        $this->faculties = Faculty::all();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'faculty_id' => 'required|numeric',
        ]);
        
        try {
            School::create([
                "name" => $this->name,
                "faculty_id" => $this->faculty_id,
            ]);
            $this->reset('name', 'faculty_id');
            $this->dispatch('message', code: '200', content: 'Se ha creado');
        } catch (\Exception $ex) {
            $this->dispatch('message', code: '500', content: 'No se pudo crear');
        }
    }

    public function render()
    {
        return view('livewire.admin.schools.form-create');
    }
}
