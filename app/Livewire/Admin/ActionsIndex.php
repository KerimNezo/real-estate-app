<?php

namespace App\Livewire\Admin;

use App\Models\Actions;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

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
            ->withTrashed()
            ->get();
    }

    #[Computed]
    public function actions()
    {
        $actions = Actions::query()
            ->select(['id', 'property_id', 'user_id', 'name', 'created_at'])
            ->latest()
            ->with(['user' => function ($query) {
                $query->select('id', 'name')->withTrashed();
            }, 'property' => function ($query) {
                $query->select('id', 'name', 'user_id')->withTrashed();
            }]);

        if (! is_null($this->actionName) && $this->actionName != '') {
            $actions = $actions->where('name', '=', $this->actionName);
        }

        if (! is_null($this->agentId) && $this->agentId > 0) {
            $actions = $actions->where('user_id', '=', $this->agentId);
        }

        $this->reset(['actionName', 'agentId']);

        return $actions->paginate(10);
    }

    public function submitForm()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.actions-index');
    }
}
