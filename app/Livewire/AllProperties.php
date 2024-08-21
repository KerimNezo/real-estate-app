<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Property;

class AllProperties extends Component
{
    public $cities;
    public $propertyCount;
    public $order;
    public $properties;
    public $filters = [
        'location' => null,
        'offer_type' => null,
        'property_type' => null,
        'min_price' => null,
        'max_price' => null,
    ];

    public function mount()
    {
        $this->fetchProperties();
    }

    public function fetchProperties()
    {
        $query = Property::query()->with(['user', 'type']);

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

    public function sortProperties($order)
    {
        $this->order = $order;
        switch ($this->order) {
            case 'lowestfirst':
                $sorted = $this->properties->sortBy('price');
                break;
            case 'highestfirst':
                $sorted = $this->properties->sortByDesc('price');
                break;
            default:
                $sorted = $this->properties->sortByDesc('created_at');
                break;
        }
        $this->properties = $sorted;
    }

    public function clearForm()
    {
        $this->filters['location'] = null;
        $this->filters['offer_type'] = null;
        $this->filters['property_type'] = null;
        $this->filters['min_price'] = null;
        $this->filters['max_price'] = null;
    }

    public function searchProperties()
    {
        $this->fetchProperties();
        $this->clearForm();
    }

    public function render()
    {
        return view('livewire.all-properties');
    }
}
