<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Property;


class AgentPropertyTable extends Component
{
    Use WithPagination;

    public $agent;

    #[Computed]
    public function properties()
    {
        $prop = Property::query()
            ->select()
            ->where('user_id', '=', $this->agent->id);

        return $prop->paginate(5);
    }
}
