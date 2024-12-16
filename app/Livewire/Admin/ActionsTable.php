<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Computed;
use Livewire\Component;

class ActionsTable extends Component
{

    #[Computed]
    public function actions()
    {
        // funkcija koja će biti computed property
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
