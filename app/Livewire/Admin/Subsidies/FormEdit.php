<?php

namespace App\Livewire\Admin\Subsidies;

use App\Models\Requirement;
use Livewire\Attributes\On;
use Livewire\Component;

class FormEdit extends Component
{
    public $subsidy;
    public $requirements;

    public $name, $description, $status;

    public $requirement_id;
    public $requirements_list = [];

    public function mount()
    {
        $this->requirements = Requirement::all();
        $this->name = $this->subsidy->name;
        $this->description = $this->subsidy->description;
        $this->status = $this->subsidy->status;
        foreach ($this->subsidy->requirements as $key => $value) {
            $this->requirements_list[$value->id] = ['is_required' => $value->pivot->is_required, 'name' => $value->name];
        }
    }

    public function addRequirement()
    {
        $this->validate([
            'requirement_id' => 'required|numeric'
        ]);
        $requirement = Requirement::find($this->requirement_id);
        // array_push($this->requirements_list, ['id' => $requirement->id, 'name'=> $requirement->name, 'is_required' => true]);
        $this->requirements_list[$this->requirement_id] = ['is_required' => true, 'name' => $requirement->name];
    }

    #[On('delete-requirement')]
    public function deleteRequirement($id)
    {
        $this->requirements_list = array_filter($this->requirements_list, fn ($value, $key) => $key !== $id, ARRAY_FILTER_USE_BOTH);
    }

    #[On('change-requirement')]
    public function changeRequirement($id, $checked)
    {
        foreach ($this->requirements_list as $key => $value) {
            if ($key == $id) {
                $this->requirements_list[$key]['is_required'] = $checked;
                break;
            }
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            // 'status' => 'required',
        ]);

        $this->subsidy->update([
            'name' => $this->name,
            'status' => $this->status,
            'description' => null,
        ]);

        $requirements_list_map = [];
        foreach ($this->requirements_list as $key => $value) {
            $requirements_list_map[$key] = ['is_required' => $value['is_required']];
        }

        $this->subsidy->requirements()->sync($requirements_list_map);
        $this->dispatch('message', code: '200', content: 'Se ha editado el registro');
    }

    public function render()
    {
        return view('livewire.admin.subsidies.form-edit');
    }
}
