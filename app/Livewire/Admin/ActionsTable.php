<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Computed;
use App\Models\Actions;
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
            ->with(['user:id,name','property:id,name'])
            ->get();

        // trebas sad ovdje još dodati da od usera uzmes ime samo a od propertya uzmes isto samo ime.
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
