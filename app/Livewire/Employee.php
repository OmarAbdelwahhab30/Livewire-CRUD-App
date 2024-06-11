<?php

namespace App\Livewire;

use AllowDynamicProperties;
use App\Livewire\Forms\EmployeeForm;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Employee extends Component
{
    use WithPagination;

    public EmployeeForm $form;

    public User $CurrentEmployee;

    #[Title("Employees")]
    #[Layout("components.layouts.app")]
    public function render()
    {
        return view('livewire.employee')
            ->with(
                [
                    'employees' => User::where("id","<>",auth()->id())->simplePaginate(2)
                ]
            );
    }

    /**
     * @throws ValidationException
     */
    public function addEmployee()
    {
        $user = $this->form->validate();

        $user = User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => Hash::make($user['password']),
        ]);

        session()->flash("success", "An employee has been added successfully");
    }

    public function editEmployee($employeeID)
    {
        $user = $this->form->validate();
        User::where("id", $employeeID)->update([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => Hash::make($user['password']),
        ]);
        session()->flash("success", "Data has been saved successfully");
    }

    public function deleteEmployee($employeeID)
    {
        $user = User::find($employeeID);
        if ($user->delete()){
            session()->flash("success", "Data has been saved successfully");
        }
        session()->flash("fail","Something went wrong !");
    }

    /* Event */
    public function clickEdit($employeeID)
    {
        $this->dispatch("clickEdit", employeeID: $employeeID);
    }


    /* Listener */
    #[On('clickEdit')]
    public function fetchEmployee($employeeID)
    {
        $employee = User::find($employeeID);
        $this->CurrentEmployee = $employee;
    }

}
