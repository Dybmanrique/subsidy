<?php

namespace App\Livewire\Admin\Faculties;

use Livewire\Attributes\Validate;
use Livewire\Component;

class FormEdit extends Component
{
    public $faculty;

    #[Validate('required|string|max:255')]
    public $name;

    public function mount() {
        $this->name = $this->faculty->name;
    }

    public function save(){
        $this->validate();
        try {
            $this->faculty->update([
                "name" => $this->name,
            ]);
            $this->dispatch('message', code: '200', content: 'Se ha actualizado');    
        } catch (\Exception $ex) {
            $this->dispatch('message', code: '500', content: 'No se pudo actualizar');    
        }
    }

    public function render()
    {
        return view('livewire.admin.faculties.form-edit');
    }
}
