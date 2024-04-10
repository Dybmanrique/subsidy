<?php

namespace App\Livewire\Admin\Vicerrectors;

use App\Models\Vicerrector;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FormCreate extends Component
{
    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|string|max:255')] 
    public $lastname;

    public function save(){
        $this->validate();
        try {
            Vicerrector::create([
                "name" => $this->name,
                "lastname" => $this->lastname,
            ]);
            $this->reset('name','lastname');
            $this->dispatch('message', code: '200', content: 'Se ha creado');    
        } catch (\Exception $ex) {
            $this->dispatch('message', code: '500', content: 'No se pudo crear');    
        }
    }

    public function render()
    {
        return view('livewire.admin.vicerrectors.form-create');
    }
}
