<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|exists:users,email')]
    public $email = '';


    #[Validate('required')]
    public $password = '';

    public function getUser()
    {
        $user = $this->validate();
        if (Auth::attempt($user)) {
            $user = User::where("email",$user['email'])->first();
            auth()->login($user);
            return redirect('/employee');
        }
        session()->flash("fail","Check Your Credentials");
        return redirect('/login');
    }
}
