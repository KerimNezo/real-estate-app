<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class AgentIndex extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.agent-index');
    }
}
