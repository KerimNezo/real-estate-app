<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Actions;
use App\Models\User;
use Livewire\Attributes\Computed;

class ActionsIndex extends Component
{
    use WithPagination;

    public $actionName;

    public $agentId;

    #[Computed]
    public function agents()
    {
        return User::query()
            ->select('id', 'name')
            ->get();
    }

    #[Computed]
    public function actions()
    {
        return Actions::query()
            ->select(['id', 'property_id', 'user_id', 'name', 'created_at'])
            ->latest()
            ->with(['user','property'])
            ->paginate(10);
    }

    public function submitForm()
    {
        logger('Form submitted');
        // this action here will just change the values of component properties, and when those change
        // by default the computed property will update.
    }

    public function render()
    {
        return view('livewire.admin.actions-index');
    }
}
