<?php

namespace App\Livewire\Admin\Postulations;

use Livewire\Component;

class FormActions extends Component
{
    public $postulation;

    public function revisarDocumentos(){
        $this->postulation->status = 'Pendiente de revisión';
        $this->postulation->save();
        $this->dispatch('message', code: '200', content: 'Hecho');
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
