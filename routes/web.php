<?php

use App\Livewire\Employee;
use App\Livewire\Login;
use App\Livewire\Register;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get("/login", Login::class);
    Route::get("/register", Register::class);
});


Route::get("/employee", Employee::class)->name("home");
