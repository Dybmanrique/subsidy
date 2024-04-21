<?php

namespace App\Livewire\Admin\Subsidies;

use App\Models\Activity;
use App\Models\Requirement;
use App\Models\Subsidy;
use Livewire\Attributes\On;
use Livewire\Component;

class FormCreate extends Component
{
    public $requirements;

    public $name, $status;

    public $requirement_id;
    public $requirements_list = [];

    public $activity_name;
    public $activities_list = [];

    public function mount()
    {
        $this->requirements = Requirement::all();
    }

    public function addRequirement()
    {
        $this->validate([
            'requirement_id' => 'required|numeric'
        ]);
        $requirement = Requirement::find($this->requirement_id);
        $this->requirements_list[$this->requirement_id] = ['is_required' => true, 'name' => $requirement->name];
    }

    public function deleteRequirement($id)
    {
        unset($this->requirements_list[$id]);
    }

    public function changeRequirement($id, $checked)
    {
        foreach ($this->requirements_list as $key => $value) {
            if ($key == $id) {
                $this->requirements_list[$key]['is_required'] = $checked;
                break;
            }
        }
    }

    public function addActivity()
    {
        $this->validate([
            'activity_name' => 'required|string|max:255'
        ]);

        array_push($this->activities_list, $this->activity_name);
        $this->reset(['activity_name']);
    }

    public function deleteActivity($id)
    {
        unset($this->activities_list[$id]);
    }

    public function save()
    {

        $this->validate([
            'name' => 'required|string|max:255',
            'status' => 'required',
        ]);

        try {
            $subsidy = Subsidy::create([
                'name' => $this->name,
                'status' => $this->status,
            ]);

            $requirements_list_map = [];
            foreach ($this->requirements_list as $key => $value) {
                $requirements_list_map[$key] = ['is_required' => $value['is_required']];
            }

            $subsidy->requirements()->attach($requirements_list_map);
            foreach ($this->activities_list as $activity) {
                Activity::create([
                    'name' => $activity,
                    'subsidy_id' => $subsidy->id
                ]);
            }
            $this->reset(['name', 'requirements_list', 'status']);
            $this->dispatch('message', code: '200', content: 'Creado, se actualizará la página');
            $this->dispatch('created');
        } catch (\Exception $ex) {
            $this->dispatch('message', code: '500', content: 'No se pudo crear');
        }
    }

    public function render()
    {
        return view('livewire.admin.subsidies.form-create');
    }
}
