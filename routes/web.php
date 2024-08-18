<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WelcomeController;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;

Route::get('/livewire', function () {
    return view('livewire');
});

Route::get('/counter', Counter::class);

Route::get('/', WelcomeController::class)
    ->name('home');

Route::get('/search', SearchController::class);

// Not my routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
