<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// Nisi napravio delete agenta, imaš iole kod, samo nisi to još implementirao iz razloga što ti ne radi
// mijenjanje agenata na propertijima, a brisanje agenta koji ima propertije je suludo, tako da kad uradiš
// property edit uzmi raditi brisanje agenta i logiku koja dolazi sa time.

// ne radi ti edit propertya nisi počeo edit agenta. tkd delete agenta će sačekat.

// trebaš uraditi responsive form view na loginu

// A nisi ni počeo raditi AGENT VIEWS cmon man. Zadaj se pravo na ovo.

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
    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    })
        ->name('dashboard');

    // Agent routes
    Route::get('admin/agent/index', [AdminController::class, 'indexAgent'])
        ->name('all-agents');

    Route::get('admin/agent/create', [AdminController::class, 'createAgent'])
        ->name('new-agent');

    Route::post('admin/agent/create', [AdminController::class, 'storeAgent'])
        ->name('store-agent');

    Route::get('admin/agent/{user}', [AdminController::class, 'showAgent'])
        ->name('single-agent');

    Route::get('admin/agent/{user}/edit', [AdminController::class, 'editAgent'])
        ->name('edit-agent');

    Route::put('admin/agent/{user}', [AdminController::class, 'updateAgent'])
        ->name('update-agent');

    Route::delete('admin/agent/{user}', [AdminController::class, 'deleteAgent'])
        ->name('delete-agent');



    // Property routes
    Route::get('admin/property/index', [AdminController::class, 'indexProperites'])
        ->name('admin-properties');

    Route::get('admin/property/create', [AdminController::class, 'createProperty'])
        ->name('new-property');

    Route::get('admin/agent/{user}/property/{property}', [AdminController::class, 'showProperty'])
        ->name('admin-single-property')
        ->scopeBindings();

    Route::get('admin/property/{property}/edit', [PropertyController::class, 'edit'])
        ->name('edit-property');

    Route::put('admin/property/{property}', [PropertyController::class, 'update'])
        ->name('update-property');

    Route::delete('admin/property/{property}', [PropertyController::class, 'destroy'])
        ->name('delete-property');

});

Route::middleware(['role:agent', 'auth', 'verified'])->group(function () {});

// Not my routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
