<?php

use App\Livewire\Catalog\DepartmentForm;
use App\Livewire\SettingForm;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::view('/', 'welcome')->name('home');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::get('settings', SettingForm::class)->name('settings');
    Route::get('departments', DepartmentForm::class)->name('departments');
});

// require __DIR__.'/settings.php';
