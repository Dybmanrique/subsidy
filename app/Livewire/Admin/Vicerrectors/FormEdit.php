<?php

namespace App\Livewire\Admin\Vicerrectors;

use Livewire\Attributes\Validate;
use Livewire\Component;

class FormEdit extends Component
{
    public $vicerrector;

    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|string|max:255')] 
    public $last_name;

    public function mount() {
        $this->name = $this->vicerrector->name;
        $this->last_name = $this->vicerrector->last_name;
    }

    public function save(){
        $this->validate();
        try {
            $this->vicerrector->update([
                "name" => $this->name,
                "last_name" => $this->last_name,
            ]);
            $this->dispatch('message', code: '200', content: 'Se ha actualizado');    
        } catch (\Exception $ex) {
            $this->dispatch('message', code: '500', content: 'No se pudo actualizar');    
        }
    }

    public function render()
    {
        return view('livewire.admin.vicerrectors.form-edit');
    }
}
