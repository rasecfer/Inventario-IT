<?php

use App\Livewire\Catalog\BrandForm;
use App\Livewire\Catalog\ClassificationForm;
use App\Livewire\Catalog\DepartmentForm;
use App\Livewire\Catalog\DeviceForm;
use App\Livewire\Catalog\DeviceList;
use App\Livewire\Catalog\DeviceModelForm;
use App\Livewire\Catalog\EmployeeForm;
use App\Livewire\Catalog\EmployeeList;
use App\Livewire\Catalog\LeaseForm;
use App\Livewire\Process\AssignmentCreate;
use App\Livewire\Process\AssignmentList;
use App\Livewire\Process\DisposalCreate;
use App\Livewire\Process\ReleaseCreate;
use App\Livewire\Process\ReleaseList;
use App\Livewire\SettingForm;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::view('/', 'welcome')->name('home');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::get('settings', SettingForm::class)->name('settings');
    Route::get('catalogs/departments', DepartmentForm::class)->name('departments');
    Route::get('catalogs/employees', EmployeeList::class)->name('employees');
    Route::get('catalogs/employees/create', EmployeeForm::class)->name('employees.create');
    Route::get('catalogs/employees/{employee_id}/edit', EmployeeForm::class)->name('employees.edit');
    Route::get('catalogs/brands', BrandForm::class)->name('brands');
    Route::get('catalogs/classifications', ClassificationForm::class)->name('classifications');
    Route::get('catalogs/models', DeviceModelForm::class)->name('models');
    Route::get('catalogs/leases', LeaseForm::class)->name('leases');
    Route::get('catalogs/devices', DeviceList::class)->name('devices');
    Route::get('catalogs/devices/create', DeviceForm::class)->name('devices.create');
    Route::get('catalogs/devices/{device_id}/edit', DeviceForm::class)->name('devices.edit');

    Route::get('processes/assignments', AssignmentList::class)->name('assignments');
    Route::get('processes/assignments/create', AssignmentCreate::class)->name('assignments.create');
    Route::get('processes/releases', ReleaseList::class)->name('releases');
    Route::get('processes/releases/create', ReleaseCreate::class)->name('releases.create');
    Route::get('processes/disposals', DisposalCreate::class)->name('disposals');
});

// require __DIR__.'/settings.php';
