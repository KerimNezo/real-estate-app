<?php

namespace App\Livewire;

use Livewire\Attributes\Locked;
use Livewire\Component;

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

/**
 * render() - expected to return a view. It gets called on initial page load and every subsequent component update.
 *            Kad god se odradi neka component funkcija, na njenom zavrsetku ce se callat i render funkcija
 */
