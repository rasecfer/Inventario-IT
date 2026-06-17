<?php

use App\Livewire\Catalog\BrandForm;
use App\Livewire\Catalog\DepartmentForm;
use App\Livewire\Catalog\EmployeeForm;
use App\Livewire\Catalog\EmployeeList;
use App\Livewire\SettingForm;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::view('/', 'welcome')->name('home');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::get('settings', SettingForm::class)->name('settings');
    Route::get('departments', DepartmentForm::class)->name('departments');
    Route::get('employees', EmployeeList::class)->name('employees');
    Route::get('employees/create', EmployeeForm::class)->name('employees.create');
    Route::get('employees/{employee_id}/edit', EmployeeForm::class)->name('employees.edit');
    Route::get('brands', BrandForm::class)->name('brands');
});

// require __DIR__.'/settings.php';
