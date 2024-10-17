<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class AgentIndex extends Component
{
    use WithPagination;

    #[Computed]
    public function agents()
    {
        $agents = User::query()
            ->select('id', 'name', 'email', 'phone_number')
            ->where('name', '!=', 'admin')
            ->latest()
            ->with(['properties']);

        return $agents->paginate(10);
    }
}
