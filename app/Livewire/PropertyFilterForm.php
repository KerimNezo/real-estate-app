<?php

namespace App\Livewire;

use Livewire\Component;

class PropertyFilterForm extends Component
{
    public $filters = [
        'location' => null,
        'offer_type' => null,
        'property_type' => null,
        'min_price' => null,
        'max_price' => null,
    ];

    public function submitForm()
    {
        $this->dispatch('form-submitted', filters: $this->filters);
    }

    public function render()
    {
        return view('livewire.property-filter-form');
    }
}
