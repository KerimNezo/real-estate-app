<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class)
    ->name('home');

Route::get('all-properties', [PropertyController::class, 'index'])
    ->name('all-properties');

Route::get('property/{id}', [PropertyController::class, 'show'])
    ->name('single-property');

Route::get('search', SearchController::class);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('user/{id}', [ProfileController::class, 'show'])
        ->name('user.show');
});

Route::middleware(['role:admin', 'auth', 'verified'])->group(function () {
    Route::get('admin/dashboard', function () {return view('admin.dashboard');})
        ->name('dashboard');

    // Agent routes
    Route::get('admin/agent/index', [AdminController::class, 'indexAgent'])
        ->name('all-agents');

    Route::get('admin/agent/create', [AdminController::class, 'createAgent'])
        ->name('new-agent');

    Route::get('admin/agent/{user}', [AdminController::class, 'showAgent'])
       ->name('single-agent');

    // Property routes
    Route::get('admin/agent/{user}/property/{property}', [AdminController::class, 'showProperty'])
        ->name('single-property')
        ->scopeBindings();

    Route::get('admin/property/index', [AdminController::class, 'indexProperites'])
        ->name('admin-properties');

    Route::get('admin/property/create', [AdminController::class, 'createProperty'])
        ->name('new-property');

});

Route::middleware(['role:agent', 'auth', 'verified'])->group(function () {

});

// Not my routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
