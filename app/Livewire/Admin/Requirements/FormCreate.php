<?php

namespace App\Livewire\Admin\Requirements;

use App\Models\Requirement;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FormCreate extends Component
{
    #[Validate('required|numeric')]
    public $max_megabytes = '';

    #[Validate('required|string|max:255')] 
    public $name = '';

    #[Validate('nullable')] 
    public $description = '';

    public function save(){
        $this->validate();
        try {
            $description = (trim($this->description) == "") ? null : $this->description;
            Requirement::create([
                "max_megabytes" => $this->max_megabytes,
                "name" => $this->name,
                "description" => $description,
            ]);
            $this->reset('max_megabytes','name','description');
            $this->dispatch('message', code: '200', content: 'Se ha creado');    
        } catch (\Exception $ex) {
            $this->dispatch('message', code: '500', content: 'No se pudo crear');    
        }
    }

    public function render()
    {
        return view('livewire.admin.requirements.form-create');
    }
}
