<?php

namespace App\Livewire\Admin\Requirements;

use Livewire\Component;

class FormEdit extends Component
{
    public $requirement;

    public $name;
    public $max_megabytes;
    public $description;

    public function mount()
    {
        $this->name = $this->requirement->name;
        $this->max_megabytes = $this->requirement->max_megabytes;
        $this->description = $this->requirement->description;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'max_megabytes' => 'required|numeric',
            'description' => 'nullable|string'
        ]);
        try {
            $description = (trim($this->description) == "") ? null : $this->description;
            $this->requirement->update([
                "max_megabytes" => $this->max_megabytes,
                "name" => $this->name,
                "description" => $description,
            ]);
            $this->dispatch('message', code: '200', content: 'Se ha editado');
        } catch (\Exception $ex) {
            $this->dispatch('message', code: '500', content: 'No se pudo editar');
        }
    }

    public function render()
    {
        return view('livewire.admin.requirements.form-edit');
    }
}
