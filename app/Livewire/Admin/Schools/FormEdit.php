<?php

namespace App\Livewire\Admin\Schools;

use App\Models\Faculty;
use Livewire\Component;

class FormEdit extends Component
{
    public $school;
    public $faculties;

    public $name, $faculty_id;

    public function mount()
    {
        $this->faculties = Faculty::all();
        $this->name = $this->school->name;
        $this->faculty_id = $this->school->faculty_id;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'faculty_id' => 'required|numeric',
        ]);
        
        try {
            $this->school->update([
                "name" => $this->name,
                "faculty_id" => $this->faculty_id,
            ]);
            $this->dispatch('message', code: '200', content: 'Se ha actualizado');
        } catch (\Exception $ex) {
            $this->dispatch('message', code: '500', content: 'No se pudo actualizar');
        }
    }

    public function render()
    {
        return view('livewire.admin.schools.form-edit');
    }
}
