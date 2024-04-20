<?php

namespace App\Livewire\Admin\Postulations;

use App\Mail\GeneralMessageMailable;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class FormActions extends Component
{
    public $postulation;
    public $title;
    public $message;

    public function sendMessage(){
        try {
            Mail::to($this->postulation->student->user->email)->send(new GeneralMessageMailable($this->title, $this->message));
            $this->dispatch('message', code: '200', content: 'Hecho, se le envió el mensaje');
            $this->reset(['title','message']);
        } catch (Exception $ex) {
            $this->dispatch('message', code: '500', content: 'Algo salió mal');
        } finally {
            $this->dispatch('close_modal');
        }
    }

    public function eliminar(){
        try {
            foreach ($this->postulation->requirements as $requirement) {
                Storage::delete($requirement->pivot->file);
            }
            $this->postulation->delete();
            $this->dispatch('message', code: '200', content: 'Hecho');
            return redirect()->route('admin.postulations.all_index', $this->postulation->announcement->subsidy->id);
        } catch (Exception $ex) {
            $this->dispatch('message', code: '500', content: 'Algo salió mal');
        }
    }
    public function aprobarDII(){
        try {
            $this->postulation->status = 'Aceptado en la Dirección del Instituto de Investigación';
            $this->postulation->save();
            $this->dispatch('message', code: '200', content: 'Hecho');
        } catch (Exception $ex) {
            $this->dispatch('message', code: '500', content: 'Algo salió mal');
        }
    }
    public function denegarDII(){
        try {
            $this->postulation->status = 'Denegado en la Dirección del Instituto de Investigación';
            $this->postulation->save();
            $this->dispatch('message', code: '200', content: 'Hecho');
        } catch (Exception $ex) {
            $this->dispatch('message', code: '500', content: 'Algo salió mal');
        }
    }
    public function aprobarConsejo(){
        try {
            $this->postulation->status = 'Aprobado en el Consejo Universitario';
            $this->postulation->save();
            $this->dispatch('message', code: '200', content: 'Hecho');
        } catch (Exception $ex) {
            $this->dispatch('message', code: '500', content: 'Algo salió mal');
        }
    }
    public function denegarConsejo(){
        try {
            $this->postulation->status = 'Denegado en el Consejo Universitario';
            $this->postulation->save();
            $this->dispatch('message', code: '200', content: 'Hecho');
        } catch (Exception $ex) {
            $this->dispatch('message', code: '500', content: 'Algo salió mal');
        }
    }
    public function reafirmar(){
        try {
            $this->postulation->status = 'Pendiente de revisión';
            $this->postulation->save();
            $this->dispatch('message', code: '200', content: 'Hecho');
        } catch (Exception $ex) {
            $this->dispatch('message', code: '500', content: 'Algo salió mal');
        }
    }

    public function render()
    {
        return view('livewire.admin.postulations.form-actions');
    }
}
