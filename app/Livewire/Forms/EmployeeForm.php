<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class EmployeeForm extends Form
{

    #[Validate('required|min:5')]
    public $name = '';

    #[Validate('required|min:6|email|unique:users,email')]
    public $email = '';

    #[Validate('required|min:6')]
    public $password = '';

    #[Validate('required|min:3|same:password')]
    public $ConfirmPassword = '';
}
