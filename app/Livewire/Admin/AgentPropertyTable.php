<?php

namespace App\Livewire\Admin;

use App\Models\Property;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class AgentPropertyTable extends Component
{
    use WithPagination;

    public $agent;

    #[Computed]
    public function properties()
    {
        $prop = Property::query()
            ->select()
            ->where('user_id', '=', $this->agent->id)
            ->with(['media' => function ($query) {
                $query->orderBy('order_column', 'asc')
                    ->limit(1);
            }]);

        return $prop->paginate(5);
    }
}
