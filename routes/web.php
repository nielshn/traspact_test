<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Livewire\EmployeeTable;
use App\Livewire\EmployeeForm;

Route::get('/', function () {
    return view('auth.login');
});

// Middleware auth
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard → tampil daftar pegawai via Livewire
    Route::get('/dashboard', EmployeeTable::class)->name('dashboard');

    // CRUD Livewire Pages
    Route::get('/employees', EmployeeTable::class)->name('employees.index');
    Route::get('/employees/create', EmployeeForm::class)->name('employees.create');
    Route::get('/employees/{employee}/edit', EmployeeForm::class)->name('employees.edit');

    // Tambahan untuk REST Controller (store, update, destroy, print)
    Route::resource('employees', EmployeeController::class)
        ->only(['store', 'update', 'destroy'])
        ->names([
            'store' => 'employees.store',
            'update' => 'employees.update',
            'destroy' => 'employees.destroy',
        ]);

    // Cetak PDF
    Route::get('/employees/print', [EmployeeController::class, 'print'])->name('employees.print');

    // Profile (dari Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
