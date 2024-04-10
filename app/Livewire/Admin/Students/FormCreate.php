<?php

namespace App\Livewire\Admin\Students;

use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\Rules;

class FormCreate extends Component
{
    public $schools;

    public $name, $last_name, $dni, $email, $phone, $condition, $school_id, $password, $password_confirmation;

    public function mount()
    {
        $this->schools = School::all();
    }

    public function save()
    {
        $this->validate([
            'dni' => 'required|numeric|digits:8|unique:students,dni',
            'email' => ['required', 'string', 'lowercase', 'email', 'regex:/^.*@unasam\.edu\.pe$/', 'max:255', 'unique:users,email'],
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'condition' => 'required',
            'school_id' => 'required|numeric',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            $user = User::create([
                'name' => $this->name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'password' => Hash::make($this->password),
            ]);
    
            Student::create([
                'dni' => $this->dni,
                'phone' => $this->phone,
                'condition' => $this->condition,
                'school_id' => $this->school_id,
                'user_id' => $user->id,
            ]);

            $this->reset('name', 'last_name', 'email', 'password', 'password_confirmation', 'dni', 'phone', 'condition', 'school_id');
            $this->dispatch('message', code: '200', content: 'Se ha creado');
        } catch (\Exception $ex) {
            $this->dispatch('message', code: '500', content: 'No se pudo crear');
        }
    }

    public function render()
    {
        return view('livewire.admin.students.form-create');
    }
}
