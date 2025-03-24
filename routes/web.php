<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;


Route::get('/', function () {
    return redirect('/properties');
    
});


Route::middleware(['auth'])->group(function () {
    Route::get('/profile/partials/delete-user-form', [ProfileController::class, 'deleteUserForm'])->name('profiles.partials.delete-user-form');});

Route::middleware(['auth'])->group(function () {
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
});


// Rutas de propiedades (públicas)
Route::get('properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('properties/{property}', [PropertyController::class, 'show'])->name('properties.show');

Route::middleware(['auth'])->group(function () {

    Route::resource('properties', PropertyController::class)->except(['index', 'show']);

    Route::post('properties/{property}/rate', [PropertyController::class, 'rate'])->name('properties.rate');
});

// Rutas del perfil del usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile/manage', [ProfileController::class, 'manage'])->name('profile.manage');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas del dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');


Route::post('properties/{property}/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');


require __DIR__.'/auth.php';
