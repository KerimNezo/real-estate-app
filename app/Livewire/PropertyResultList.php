<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class PropertyResultList extends Component
{
    public $properties = [];

    public $propertyCount = 0;

    public $query;

    #[Computed]
    #[On('form-submitted')]
    public function updateProperties($filters)
    {
        $this->reset(['query', 'properties', 'propertyCount']);

        $query = Property::query()->with(['media' => function ($query) {
            $query->limit(1);
        }]);

        if ($filters['location']) {
            $query->where('city', '=', $filters['location']);
        }

        if ($filters['offer_type']) {
            $query = match ($filters['offer_type']) {
                '1' => $query->whereNull('lease_duration'), // sell
                '2' => $query->whereNotNull('lease_duration'), // rent
                default => $query,
            };
        }

        if ($filters['property_type']) {
            $query->where('type_id', '=', $filters['property_type']);
        }

        if ($filters['min_price']) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if ($filters['max_price']) {
            $query->where('price', '<=', $filters['max_price']);
        }

        $this->properties = $query->get();
        $this->propertyCount = $this->properties->count();
    }

    public function sortProperties($order)
    {
        $sortBy = match ($order) {
            'lowestfirst' => 'price',
            'highestfirst' => 'price',
            default => 'created_at',
        };

        $this->properties = $this->properties->sortBy($sortBy, SORT_REGULAR, $order === 'highestfirst');
    }

    public function render()
    {
        return view('livewire.property-result-list');
    }
}
