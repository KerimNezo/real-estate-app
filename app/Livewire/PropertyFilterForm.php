<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Property;

class PropertyFilterForm extends Component
{
    #[Computed]
    public function cities()
    {
        return Property::pluck('city')->unique()->values();
    }

    public $filters = [
        'location' => null,
        'offer_type' => null,
        'property_type' => null,
        'min_price' => null,
        'max_price' => null,
        'sort' => 'created_at',
    ];

    public function clearForm()
    {
        $this->reset('filters');
    }

    public function submitForm()
    {
        $this->dispatch('form-submitted', filters: $this->filters);
        $this->clearForm();
    }

    public function render()
    {
        return view('livewire.property-filter-form');
    }
}
