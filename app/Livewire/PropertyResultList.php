<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Attributes\On;
use Livewire\Component;

class PropertyResultList extends Component
{
    public $properties = [];

    public $propertyCount = 0;

    #[On('form-submitted')]
    public function updateProperties($filters)
    {
        $this->reset(['properties', 'propertyCount']);

        $query = Property::query()
            ->select('id', 'type_id', 'name', 'price', 'city', 'bedrooms', 'garage', 'furnished', 'floors', 'lease_duration', 'keycard_entry', 'surface', 'toilets');

        if ($filters['location']) {
            $query->where('city', '=', $filters['location']);
        }

        if ($filters['offer_type']) {
            $query = match ($filters['offer_type']) {
                '1' => $query->whereNull('lease_duration'),
                '2' => $query->whereNotNull('lease_duration'),
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

        $this->properties = $query
            ->with(['media' => function ($query) {
                $query->orderBy('order_column', 'asc')
                    ->limit(1);
            }])
            ->latest()
            ->get();

        $this->propertyCount = $this->properties->count();
    }

    public function sortProperties($order)
    {
        $sortBy = match ($order) {
            'lowestfirst' => 'price',
            'highestfirst' => 'price',
            default => 'created_at',
        };

        $this->properties = $order === 'lowestfirst'
            ? $this->properties->sortBy($sortBy)
            : $this->properties->sortByDesc($sortBy);
    }

    public function render()
    {
        return view('livewire.property-result-list');
    }
}
