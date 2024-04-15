<?php

namespace App\Livewire\Postulation;

use Livewire\Component;

class ViewDocuments extends Component
{
    public $postulation;

    public function mount(){
        
    }

    public function render()
    {
        return view('livewire.postulation.view-documents');
    }
}
