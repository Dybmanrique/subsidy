<?php

namespace App\Livewire\Admin\Postulations;

use App\Mail\GeneralMessageMailable;
use App\Models\State;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class FormActions extends Component
{
    public $postulation;

    public $title;
    public $message;

    public $states;
    public $state_id;
    public $description;
    public $is_sendable = false;

    public function sendMessage()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'message' => 'nullable|string|max:3500',
        ]);

        try {
            Mail::to($this->postulation->student->user->email)->send(new GeneralMessageMailable($this->title, $this->message));
            $this->dispatch('message', code: '200', content: 'Hecho, se le envió el mensaje');
            $this->reset(['title', 'message']);
        } catch (Exception $ex) {
            $this->dispatch('message', code: '500', content: 'Algo salió mal');
        } finally {
            $this->dispatch('close_modal');
        }
    }

    public function addState()
    {
        $this->validate([
            'state_id' => 'required|numeric|min:3',
            'description' => 'nullable|string|max:3500',
            'is_sendable' => 'required|boolean',
        ]);
        try {
            if (trim($this->description) === "") $this->description = null;
    
            $this->postulation->states()->attach($this->state_id, ['description' => $this->description]);
            if ($this->is_sendable) {
                $title = State::find($this->state_id)->name;
                $message = $this->description;
                Mail::to($this->postulation->student->user->email)->send(new GeneralMessageMailable($title, $message));
            }
            $this->reset(['state_id', 'description', 'is_sendable']);
            $this->dispatch('message', code: '200', content: 'Hecho');
        } catch (Exception $ex) {
            $this->dispatch('message', code: '500', content: 'Algo salió mal');
        } finally {
            $this->dispatch('close_modal_change');
        }
    }

    public function eliminar()
    {   
        try {
            if($this->postulation->states()->orderBy('postulation_state.created_at', 'desc')->first()->id >= 3){
                $this->dispatch('message', code: '500', content: 'Esta postulación no se puede eliminar');
                return;
            }

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
    public function mount()
    {
        $this->states = State::where('id','>','2')->get();
    }

    public function render()
    {
        return view('livewire.admin.postulations.form-actions');
    }
}
