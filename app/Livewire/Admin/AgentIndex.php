<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

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
            ->with(['properties', 'media']);

        return $agents->paginate(10);
    }
}
