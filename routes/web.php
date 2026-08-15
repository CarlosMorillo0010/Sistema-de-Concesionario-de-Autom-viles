<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'car.access'])->group(function () {
    Route::resource('cars', CarController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'car.access'])->get('/admin', function () {
    return view('admin.dashboard', [
        'total' => \App\Models\Car::count(),
        'promedioPrecio' => \App\Models\Car::avg('precio'),
        'porMarca' => \App\Models\Car::selectRaw('marca, count(*) as total')->groupBy('marca')->get(),
    ]);
})->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
