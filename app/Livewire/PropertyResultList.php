<?php

namespace App\Livewire;

use Livewire\Component;

class PropertyResultList extends Component
{
    public $properties;
    public $order;
    public $propertyCount;

    protected $listeners = ['filterUpdated' => 'updateProperties'];

    public function updateProperties($filters)
    {
        // Use the $filters to query the properties
        $this->properties = Property::query()
            ->when($filters['location'], fn($query) => $query->where('city', $filters['location']))
            // Add other filters...
            ->get();
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

    /**
     * public function fetchProperties()
    {
        $query = Property::query()
        ->select('id', 'type_id', 'name', 'price', 'city', 'bedrooms', 'garage', 'furnished', 'floors', 'lease_duration', 'keycard_entry', 'surface', 'toilets')
        ->with(['media' => function ($query) {
            $query->limit(1);
        }]);

        if ($this->filters['location']) {
            $query->where('city', '=', $this->filters['location']);
        }

        if ($this->filters['offer_type']) {
            $query = match ($this->filters['offer_type']) {
                '1' => $query->whereNull('lease_duration'), // sell
                '2' => $query->whereNotNull('lease_duration'), // rent
                default => $query,
            };
        }

        if ($this->filters['property_type']) {
            $query->where('type_id', '=', $this->filters['property_type']);
        }

        if ($this->filters['min_price']) {
            $query->where('price', '>=', $this->filters['min_price']);
        }

        if ($this->filters['max_price']) {
            $query->where('price', '<=', $this->filters['max_price']);
        }

        switch ($this->order) {
            case 'lowestfirst':
                $query->orderBy('price', 'asc');
                break;
            case 'highestfirst':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $this->properties = $query->get();
        $this->propertyCount = $this->properties->count();
    }
     */
}
