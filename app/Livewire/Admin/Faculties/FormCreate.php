<?php

namespace App\Livewire\Admin\Faculties;

use App\Models\Faculty;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FormCreate extends Component
{
    #[Validate('required|string|max:255')]
    public $name;

    public function save(){
        $this->validate();
        try {
            Faculty::create([
                "name" => $this->name,
            ]);
            $this->reset('name');
            $this->dispatch('message', code: '200', content: 'Se ha creado');    
        } catch (\Exception $ex) {
            $this->dispatch('message', code: '500', content: 'No se pudo crear');    
        }
    }

    public function render()
    {
        return view('livewire.admin.faculties.form-create');
    }
}
