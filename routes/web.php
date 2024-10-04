<?php

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

// This ProfileController action does not exist, and I will need to finish it
Route::get('/user/{id}', [ProfileController::class, 'show'])
    ->name('user.show');

// Not my routes
Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
