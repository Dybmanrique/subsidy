<?php

namespace App\Livewire\Postulation;

use App\Models\Postulation;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\WithFileUploads;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MyPostulations extends Component
{
    use WithFileUploads;
    public $postulations;
    public $postulation_id;

    public $model_open = false;
    public $file_modal;
    public $signature;

    public function mount(){
        $this->postulations = Postulation::where('student_id', auth()->user()->student->id)->orderByDesc('id')->get();
    }

    public function setPostulationId($id){
        $this->postulation_id = $id;
    }

    public function generateSolicitude(){
        $this->validate([
            'file_modal' => 'nullable|mimes:png,jpg'
        ]);
        
        $postulation = Postulation::find($this->postulation_id);
        if($this->file_modal){
            $this->signature = base64_encode(file_get_contents($this->file_modal->getRealPath()));
        } else {
            $this->signature = null;
        }
        
        $url = route('postulations.view_documents', $postulation);
        $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($url));
        $data = [
            'postulation' => $postulation,
            'user' => auth()->user(),
            'qrcode' => $qrcode,
            'url' => $url,
            'signature' => $this->signature
        ];
        
        $pdf = Pdf::loadView('postulations.solicitude', $data)->output();
        $this->model_open = false;
        return response()->streamDownload(
            fn() => print($pdf),
            'Solicitud '. $postulation->name.'.pdf'
        );
    }

    public function render()
    {
        return view('livewire.postulation.my-postulations');
    }
}
