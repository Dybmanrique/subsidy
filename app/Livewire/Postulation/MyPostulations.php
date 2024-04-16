<?php

namespace App\Livewire\Postulation;

use App\Models\Postulation;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class MyPostulations extends Component
{
    public $postulations;

    public function mount(){
        $this->postulations = Postulation::where('student_id', auth()->user()->student->id)->orderByDesc('id')->get();
    }

    public function generateSolicitude(Postulation $postulation){
        $data = [];
        $pdf = Pdf::loadView('postulations.solicitude', $data)->output();
        return response()->streamDownload(
            fn() => print($pdf),
            'Solicitud.pdf'
        );
    }

    public function render()
    {
        return view('livewire.postulation.my-postulations');
    }
}
