<?php

namespace App\Livewire\Admin\Subsidies;

use App\Models\Activity;
use App\Models\Requirement;
use Livewire\Component;

class FormEdit extends Component
{
    public $subsidy;
    public $requirements;

    public $name, $status;

    public $requirement_id;
    public $requirements_list = [];

    public $activity_name;
    public $activities_list = [];

    public function mount()
    {
        $this->requirements = Requirement::all();
        $this->name = $this->subsidy->name;
        $this->status = $this->subsidy->status;
        foreach ($this->subsidy->requirements as $key => $value) {
            $this->requirements_list[$value->id] = ['is_required' => $value->pivot->is_required, 'name' => $value->name];
        }
        foreach ($this->subsidy->activities()->where('status','activo')->get() as $key => $activity) {
            array_push($this->activities_list, $activity->name);
        }
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
        $password_changed = ($this->subsidy->status !== $this->status);
            
        try {
            $this->subsidy->update([
                'name' => $this->name,
                'status' => $this->status,
            ]);

            $requirements_list_map = [];
            foreach ($this->requirements_list as $key => $value) {
                $requirements_list_map[$key] = ['is_required' => $value['is_required']];
            }

            foreach ($this->subsidy->activities as $key => $activity) {
                if ($activity->postulations()->exists()) {
                    $activity->update([
                        'status' => 'inactivo'
                    ]);
                } else {
                    $activity->delete();
                }
            }

            foreach ($this->activities_list as $key => $activity) {
                Activity::updateOrCreate([
                    'name' => $activity,
                    'subsidy_id' => $this->subsidy->id
                ], ['status' => 'activo']);
            }

            $this->subsidy->requirements()->sync($requirements_list_map);

            if($password_changed){
                $this->dispatch('message', code: '200', content: 'Hecho, se actualizará la página');
                $this->dispatch('refresh');
            } else {
                $this->dispatch('message', code: '200', content: 'Se actualizó correctamente');
            }
        } catch (\Exception $ex) {
            $this->dispatch('message', code: '500', content: 'No se pudo actualizar');
        }
    }

    public function render()
    {
        return view('livewire.admin.subsidies.form-edit');
    }
}
