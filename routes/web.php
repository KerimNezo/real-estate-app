<?php

use App\Http\Controllers\ActionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

Route::fallback(function () {
    if (Auth::user() !== null && Auth::user()->hasRole('admin')) {
        return redirect()->route('dashboard');
    } elseif (Auth::user() !== null && Auth::user()->hasRole('agent')) {
        return redirect()->route('agent-dashboard');
    } else {
        return redirect('/');
    }
}); 

Route::get('/', WelcomeController::class)
    ->name('home');

Route::get('all-properties', [PropertyController::class, 'index'])
    ->name('all-properties');

Route::get('property/{id}', [PropertyController::class, 'show'])
    ->name('single-property')
    ->missing(function (Request $request) {
        return Redirect::route('all-properties')->with('error', 'Property does not exist.');
    });;

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
        ->name('single-agent')
        ->missing(function (Request $request) {
            return Redirect::route('all-agents')->with('error', 'Agent does not exist.');
        });

    Route::get('admin/agent/{user}/edit', [AdminController::class, 'editAgent'])
        ->name('edit-agent')
        ->missing(function (Request $request) {
            return Redirect::route('all-agents')->with('error', 'Agent does not exist.');
        });;

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
        ->scopeBindings()
        ->missing(function (Request $request) {
            return Redirect::route('admin-properties')->with('error', 'Property does not exist.');
        });

    Route::get('admin/property/{property}/edit', [PropertyController::class, 'edit'])
        ->name('edit-property')
        ->missing(function (Request $request) {
            return Redirect::route('admin-properties')->with('error', 'Property does not exist.');
        });

    Route::delete('admin/property/{property}', [PropertyController::class, 'destroy'])
        ->name('delete-property');

    // Action routes
    Route::get('admin/activity/index', [ActionsController::class, 'index'])
        ->name('admin-actions');

    Route::get('admin/activity/{id}', [ActionsController::class, 'show'])
        ->name('admin-single-action')
        ->missing(function (Request $request) {
            return Redirect::route('admin-actions')->with('error', 'Action does not exist.');
        });
});

Route::middleware(['role:agent', 'auth', 'verified'])->group(function () {
   
    Route::get('agent/dashboard', [AgentController::class, 'dashboard'])
        ->name('agent-dashboard');

    // Property routes
    Route::get('agent/profile', [AgentController::class, 'show'])
        ->name('agent-show');

    Route::get('agent/property/index', [AgentController::class, 'indexProperties'])
        ->name('agent-properties');

    Route::get('agent/property/create', [PropertyController::class, 'create'])
        ->name('agent-new-property');

    Route::get('agent/property/{property}', [AgentController::class, 'showProperty'])
        ->name('agent-single-property')
        ->missing(function (Request $request) {
            return Redirect::route('agent-properties')->with('error', 'Property does not exist.');
        });

    Route::get('agent/property/{property}/edit', [PropertyController::class, 'edit'])
        ->name('agent-edit-property')
        ->missing(function (Request $request) {
            return Redirect::route('agent-properties')->with('error', 'Property does not exist.');
        });
});

// Not my routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
