<?php

namespace App\Livewire;

use App\Livewire\Forms\LoginForm;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{

    public LoginForm $form;

    #[Title('Login')]
    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.login');
    }


    public function login()
    {
        $this->form->getUser();
    }
}
