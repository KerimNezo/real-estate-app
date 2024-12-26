<?php

namespace App\Livewire\Admin;

use App\Models\Property;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class AgentPropertyTable extends Component
{
    use WithPagination;

    public $agent;

    #[Computed]
    public function properties()
    {
        $prop = Property::query()
            ->select()
            ->withTrashed()
            ->where('user_id', '=', $this->agent->id)
            ->with(['media' => function ($query) {
                $query->orderBy('order_column', 'asc')
                    ->limit(1);
            }]);

        if(Auth::user()->hasRole('agent')) {
            $prop = $prop->where('status', '=', 'Unavailable');
        }

        return $prop->paginate(5);
    }
}
