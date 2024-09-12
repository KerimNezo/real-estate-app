<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Locked;

class PropertyFilterForm extends Component
{

    #[Locked]
    public $cities;

    public $filters = [
        'location' => null,
        'offer_type' => null,
        'property_type' => null,
        'min_price' => null,
        'max_price' => null,
    ];

    public function clearForm()
    {
        $this->filters = array_fill_keys([
            'location',
            'offer_type',
            'property_type',
            'min_price',
            'max_price'], null);
    }

    public function submitForm()
    {
        $this->dispatch('form-submitted', filters: $this->filters);
    }

    public function render()
    {
        return view('livewire.property-filter-form');
    }
}
