<?php

namespace App\Livewire\Postulation;

use App\Models\Postulation;
use Livewire\Component;

class MyPostulations extends Component
{
    public $postulations;

    public function mount(){
        $this->postulations = Postulation::where('student_id', auth()->user()->student->id)->get();
    }

    public function render()
    {
        return view('livewire.postulation.my-postulations');
    }
}
