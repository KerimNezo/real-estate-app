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
            ->with(['media', 'properties' => function ($query) {
                $query->orderBy('created_at', 'asc')
                    ->with(['media' => function ($query) {
                        $query->orderBy('order_column', 'asc')
                            ->limit(1);
                    }])
                    ->limit(1);
            }]);

        return $agents->paginate(10);
    }
}
