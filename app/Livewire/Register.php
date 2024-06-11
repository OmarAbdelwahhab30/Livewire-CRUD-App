<?php

namespace App\Livewire;

use App\Livewire\Forms\RegisterForm;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Register extends Component
{

    public RegisterForm $form;

    #[Title('Register')]
    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.register');
    }

    public function register()
    {
        $this->form->store();
    }

}
