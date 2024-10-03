<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class FormCreate extends Component
{
    //ATRIBUTOS
    public $email;
    public $name;
    public $status;
    public $last_name;
    public $password;
    public $password_confirmation;

    public function mount() {}

    public function save()
    {
        $this->validate([
            'email' => 'required|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        try {

            User::create([
                "email" => $this->email,
                "name" => $this->name,
                "is_admin" => 1,
                "status" => $this->status,
                "last_name" => $this->last_name,
                'email_verified_at' => Carbon::now(),
                "password" => Hash::make($this->password),
            ]);

            $this->reset('email', 'password', 'password_confirmation', 'name', 'last_name','status');
            $this->dispatch('message', code: '200', content: 'Hecho');
        } catch (\Exception $ex) {
            $this->dispatch('message', code: '500', content: 'No se pudo crear el usuario');
        }
    }

    public function render()
    {
        return view('livewire.admin.users.form-create');
    }
}
