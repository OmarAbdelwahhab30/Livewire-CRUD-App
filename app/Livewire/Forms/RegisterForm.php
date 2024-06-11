<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RegisterForm extends Form
{
    #[Validate('required|min:5')]
    public $name = '';

    #[Validate('required|min:6|email|unique:users,email')]
    public $email = '';

    #[Validate('required|min:6')]
    public $password = '';

    #[Validate('required|min:3|same:password')]
    public $conPassword = '';

    public function store()
    {
        $user = $this->validate();

        $user = User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => Hash::make($user['password']),
        ]);

        auth()->login($user);

        return redirect("/employee");
    }
}
