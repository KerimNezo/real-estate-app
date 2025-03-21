<?php

namespace App\Livewire\Admin;

use App\Models\Actions;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ActionsTable extends Component
{
    #[Computed]
    public function actions()
    {
        return Actions::query()
            ->select(['id', 'property_id', 'user_id', 'name', 'created_at'])
            ->latest()
            ->limit(5)
            ->with(['user' => function ($query) {
                $query->select('id', 'name')->withTrashed();
            }, 'property' => function ($query) {
                $query->select('id', 'name', 'user_id')->withTrashed();
            }])
            ->get();
    }

    public function refreshActions()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.actions-table');
    }
}
