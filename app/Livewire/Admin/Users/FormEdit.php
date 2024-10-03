<?php

namespace App\Livewire\Admin\Users;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Component;

class FormEdit extends Component
{
    public $user;
    //ATRIBUTOS
    public $email;
    public $name;
    public $status;
    public $last_name;
    public $password;
    public $password_confirmation;

    public function mount() {
        $this->email = $this->user->email;
        $this->name = $this->user->name;
        $this->status = $this->user->status;
        $this->last_name = $this->user->last_name;
    }

    public function save()
    {
        $this->validate([
            'email' => 'required|max:255|unique:users,email,' . $this->user->id,
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $hasPassword = ($this->password !== "" && $this->password !== null);

        if ($hasPassword) {
            $this->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
        }

        try {

            $this->user->update([
                "email" => $this->email,
                "name" => $this->name,
                "is_admin" => 1,
                "status" => $this->status,
                "last_name" => $this->last_name,
                // "password" => Hash::make($this->password),
            ]);

            if($hasPassword){
                $this->user->update([
                    "password" => Hash::make($this->password),
                ]);
            }

            $this->reset(['password','password_confirmation']);
            $this->dispatch('message', code: '200', content: 'Hecho');
        } catch (\Exception $ex) {
            $this->dispatch('message', code: '500', content: 'No se pudo crear el usuario');
        }
    }

    public function render()
    {
        return view('livewire.admin.users.form-edit');
    }
}
