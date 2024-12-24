<?php

use App\Http\Controllers\ActionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// A nisi ni počeo raditi AGENT VIEWS cmon man. Zadaj se pravo na ovo.

Route::get('/', WelcomeController::class)
    ->name('home');

Route::get('all-properties', [PropertyController::class, 'index'])
    ->name('all-properties');

Route::get('property/{id}', [PropertyController::class, 'show'])
    ->name('single-property');

Route::get('search', SearchController::class);

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

    // Property routes
    Route::get('admin/property/index', [AdminController::class, 'indexProperites'])
        ->name('admin-properties');

    Route::get('admin/property/create', [AdminController::class, 'createProperty'])
        ->name('new-property');

    Route::post('admin/property/create', [AdminController::class, 'storeProperty'])
        ->name('store-property');

    Route::get('admin/agent/{user}/property/{property}', [AdminController::class, 'showProperty'])
        ->name('admin-single-property')
        ->scopeBindings();

    Route::get('admin/property/{property}/edit', [PropertyController::class, 'edit'])
        ->name('edit-property');

    Route::put('admin/property/{property}', [PropertyController::class, 'update'])
        ->name('update-property');

    Route::delete('admin/property/{property}', [PropertyController::class, 'destroy'])
        ->name('delete-property');

    // Action routes
    Route::get('admin/action/index', [ActionsController::class, 'index'])
        ->name('admin-actions');

    Route::get('admin/action/{id}', [ActionsController::class, 'show'])
        ->name('admin-single-action');
});

Route::middleware(['role:agent', 'auth', 'verified'])->group(function () {
    Route::get('agent/dashboard', [AgentController::class, 'dashboard'])
        ->name('agent-dashboard');

    // Property routes
    Route::get('agent/profile', [AgentController::class, 'show'])
        ->name('agent-show');

    Route::get('agent/property/index', [AgentController::class, 'indexProperties'])
        ->name('agent-properties');

    Route::get('agent/property/{property}', [AgentController::class, 'showProperty'])
        ->name('agent-single-property');

    Route::get('agent/property/create', [PropertyController::class, 'create'])
        ->name('agent-new-property');

    Route::post('agent/property/create', [])
        ->name('agent-store-property');

    Route::get('agent/property/{property}/edit', [AgentController::class, 'editProperty'])
        ->name('agent-edit-property');

    Route::put('agent/property/{property}', [PropertyController::class, 'update'])
        ->name('agent-update-property');
});

// Not my routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
