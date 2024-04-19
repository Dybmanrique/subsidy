<?php

namespace App\Livewire\Admin\Postulations;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class FormActions extends Component
{
    public $postulation;

    public function eliminar(){
        // $this->postulation->status = 'Pendiente de revisión';
        foreach ($this->postulation->requirements as $requirement) {
            Storage::delete($requirement->pivot->file);
        }
        $this->postulation->delete();
        $this->dispatch('message', code: '200', content: 'Hecho');
        return redirect()->route('admin.postulations.all_index', $this->postulation->announcement->subsidy->id);
    }
    public function aprobarDII(){
        $this->postulation->status = 'Aceptado en la Dirección del Instituto de Investigación';
        $this->postulation->save();
        $this->dispatch('message', code: '200', content: 'Hecho');
    }
    public function denegarDII(){
        $this->postulation->status = 'Denegado en la Dirección del Instituto de Investigación';
        $this->postulation->save();
        $this->dispatch('message', code: '200', content: 'Hecho');
    }
    public function aprobarConsejo(){
        $this->postulation->status = 'Aprobado en el Consejo Universitario';
        $this->postulation->save();
        $this->dispatch('message', code: '200', content: 'Hecho');
    }
    public function denegarConsejo(){
        $this->postulation->status = 'Denegado en el Consejo Universitario';
        $this->postulation->save();
        $this->dispatch('message', code: '200', content: 'Hecho');
    }
    public function reafirmar(){
        $this->postulation->status = 'Aceptado en la Dirección del Instituto de Investigación';
        $this->postulation->save();
        $this->dispatch('message', code: '200', content: 'Hecho');
    }

    public function render()
    {
        return view('livewire.admin.postulations.form-actions');
    }
}
