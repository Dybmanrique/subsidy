<?php

namespace App\Livewire\Admin\Students;

use App\Models\School;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\Rules;

class FormEdit extends Component
{
    public $student;
    public $schools;

    public $name, $last_name, $dni, $email, $phone, $condition, $school_id, $password, $password_confirmation;

    public function mount()
    {
        $this->schools = School::all();
        $this->name = $this->student->user->name;
        $this->last_name = $this->student->user->last_name;
        $this->dni = $this->student->dni;
        $this->phone = $this->student->phone;
        $this->condition = $this->student->condition;
        $this->school_id = $this->student->school_id;
        $this->email = $this->student->user->email;
    }

    public function save()
    {
        $this->validate([
            'dni' => 'required|numeric|digits:8|unique:students,dni,'.$this->student->id,
            'email' => ['required', 'string', 'lowercase', 'email', 'regex:/^.*@unasam\.edu\.pe$/', 'max:255', 'unique:users,email,'.$this->student->user->id],
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'condition' => 'required',
            'school_id' => 'required|numeric',
        ]);

        $there_is_password = $this->password != null || $this->password != '';
        if($there_is_password){
            $this->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
        }

        try {
            $this->student->user->update([
                'name' => $this->name,
                'last_name' => $this->last_name,
                'email' => $this->email,
            ]);

            if($there_is_password){
                $this->student->user->update([
                    'password' => Hash::make($this->password),
                ]); 
            }
    
            $this->student->update([
                'dni' => $this->dni,
                'phone' => $this->phone,
                'condition' => $this->condition,
                'school_id' => $this->school_id,
            ]);

            $this->dispatch('message', code: '200', content: 'Se ha actualizado');
            $this->reset(['password','password_confirmation']);
        } catch (\Exception $ex) {
            $this->dispatch('message', code: '500', content: 'No se pudo actualizar');
        }
    }

    public function render()
    {
        return view('livewire.admin.students.form-edit');
    }
}
