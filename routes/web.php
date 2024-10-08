<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class)
    ->name('home');

Route::get('/all-properties', [PropertyController::class, 'index'])
    ->name('all-properties');

Route::get('property/{id}', [PropertyController::class, 'show'])
    ->name('single-property');

Route::get('/search', SearchController::class);

// Here we will add routes that user with admin role will have access to
Route::middleware(['auth', 'verified'])->group(function () {
    // Here we will have routes that both admin and agent will have access to
    // but we will limit what each of them will have displayed based on their roles

    Route::get('/user/{id}', [ProfileController::class, 'show'])
        ->name('user.show');
});

// Here we will add routes that user with admin role will have access to
Route::middleware(['role:admin', 'auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {return view('admin.index');})->name('dashboard');
    Route::get('/agent/index', [AdminController::class, 'showAgents'])->name('all-agents');
    //Route::get('/agent/{id}', [AdminController::class, 'showAgent'])->name('single-agent');

    Route::get('/property/houses', [AdminController::class, 'showHouses'])->name('all-houses');
    Route::get('/property/offices', [AdminController::class, 'showOffices'])->name('all-offices');
    Route::get('/property/appartements', [AdminController::class, 'showAppartements'])->name('all-appartements');
});

// Here we will add routes that user with agent role will have access to
Route::middleware(['role:agent', 'auth', 'verified'])->group(function () {
    // Here we wil have routes that agents will use
});

// Not my routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
