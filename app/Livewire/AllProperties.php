<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Component;

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
        if ($this->properties) {
        } else {
            $this->fetchProperties();
        }

    }
    // mount() is used to set up our component for its initial display on our page

    // updated() is hook used to manage to our component property and its value before they hit our controller
    // could be used to check input and validate user data -> This is where we do validation

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
        logger($this->properties);
        if ($this->properties->isEmpty()) {
            logger('empty je je');
        }
    }

    public function sortProperties($order)
    {
        // assigns by what property do we want to sort our list of properties
        $sortBy = match ($order) {
            'lowestfirst' => 'price',
            'highestfirst' => 'price',
            default => 'created_at',
        };

        // Here we are using ternary operator to check if the order is lowestfirst
        // if that is true we will just order properties by price going from cheapest first in ascending order
        // if it is false, we will descend from either most expensive property, or the one created last in the DB
        $this->properties = $order === 'lowestfirst'
            ? $this->properties->sortBy($sortBy)
            : $this->properties->sortByDesc($sortBy);
    }

    public function clearForm()
    {
        // Will array assign the value null to form inputs
        $this->filters = array_fill_keys([
            'location',
            'offer_type',
            'property_type',
            'min_price',
            'max_price'], null);
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
