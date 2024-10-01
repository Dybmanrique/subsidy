<?php

namespace App\Livewire\Postulation;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class UploadDocuments extends Component
{
    use WithFileUploads;

    public $postulation;
    public $subsidy;
    public $requirements;

    public $activity_items;
    public $name, $budget, $student_members, $graduated_members, $activity_id, $adviser;

    public $model_open = false;
    public $requirement_modal_id;
    public $file_modal;

    public function mount()
    {
        $this->subsidy = $this->postulation->announcement->subsidy;
        $this->requirements = $this->postulation->announcement->subsidy->requirements;
        $this->activity_items = $this->postulation->announcement->subsidy->activities()->where('status', 'activo')->get();
        $this->name = $this->postulation->name;
        $this->activity_id = $this->postulation->activity_id;
        $this->adviser = $this->postulation->adviser;
        $this->budget = $this->postulation->budget;
        $this->student_members = $this->postulation->student_members;
        $this->graduated_members = $this->postulation->graduated_members;
    }

    public function updateGeneralData()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'adviser' => 'nullable|string|max:255',
            'budget' => 'required|numeric',
            'student_members' => 'required|numeric|max:200',
            'graduated_members' => 'required|numeric|max:200',
            'activity_id' => 'required|numeric',
        ]);

        $adviser = (trim($this->adviser) == "") ? null : $this->adviser;

        $this->postulation->update([
            'name' => $this->name,
            'activity_id' => $this->activity_id,
            'budget' => $this->budget,
            'student_members' => $this->student_members,
            'graduated_members' => $this->graduated_members,
            'adviser' => $adviser,
        ]);

        $this->dispatch('message', code: '200', content: 'Se han actualizado los datos generales');
    }

    public function setRequirementModal($requirement_id)
    {
        $this->requirement_modal_id = $requirement_id;
    }

    public function uploadFile()
    {
        $this->validate([
            'file_modal' => 'mimes:pdf,bin'
        ]);

        $requirement = $this->postulation->requirements()->where('requirement_id', $this->requirement_modal_id)->first();
        if ($requirement) {
            Storage::delete($requirement->pivot->file);
            $file_location = $this->file_modal->storeAS("public/requirements/$this->requirement_modal_id", Uuid::uuid1()->toString() . '.pdf');
            $requirement->pivot->file = $file_location;
            $requirement->pivot->save();
        } else {
            $file_location = $this->file_modal->storeAS("public/requirements/$this->requirement_modal_id", Uuid::uuid1()->toString() . '.pdf');
            $this->postulation->requirements()->attach([$this->requirement_modal_id => ['file' => $file_location]]);
        }
        $this->model_open = false;
    }

    public function deleteFile($requirement_id)
    {
        $requirement = $this->postulation->requirements()->where('requirement_id', $requirement_id)->first();
        if ($requirement) {
            Storage::delete($requirement->pivot->file);
            $requirement->pivot->delete();
        }
    }

    public function confirmRequirements()
    {
        foreach ($this->postulation->announcement->subsidy->requirements as $key => $requirement) {
            if ($requirement->pivot->is_required) {
                $file_requirement = $this->postulation->requirements()->where('requirement_id', $requirement->id)->first();
                if (!$file_requirement) {
                    $this->dispatch('message', code: '500', content: 'Aún no ha subido el Requisito ' . ($key + 1) . ' recuerde que es obligatorio');
                    return;
                }
            }
        }
        // 2 = Pendiente de revisión
        $this->postulation->states()->attach('2');
        $this->postulation->update([
            'editable_up_to' => null
        ]);
        redirect()->route('postulations.my_postulations');
    }

    public function render()
    {
        return view('livewire.postulation.upload-documents');
    }
}
