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
        try {
            $this->validate([
                'state_id' => 'required|numeric',
                'description' => 'required|string|max:3500',
                'is_sendable' => 'required|boolean',
            ]);
    
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
            $this->dispatch('close_modal');
        }
    }

    public function eliminar()
    {
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
    public function mount()
    {
        $this->states = State::all();
    }

    public function render()
    {
        return view('livewire.admin.postulations.form-actions');
    }
}
