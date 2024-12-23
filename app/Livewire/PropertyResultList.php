<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Attributes\On;
use Livewire\Component;

class PropertyResultList extends Component
{
    public $properties = [];

    public $query;

    #[On('form-submitted')]
    public function updateProperties($filters)
    {
        $this->reset(['properties']);

        $query = Property::query()
            ->select('id', 'type_id', 'name', 'price', 'city', 'bedrooms', 'garage', 'furnished', 'floors', 'lease_duration', 'keycard_entry', 'surface', 'toilets')
            ->where('status', '=', 'Available');

        if ($filters['location']) {
            $query->where('city', '=', $filters['location']);
        }

        if ($filters['offer_type']) {
            $query = match ($filters['offer_type']) {
                '1' => $query->where('lease_duration', '=', null)
                        ->orWhere('lease_duration', '=', 0), // sell
                '2' => $query->whereNotNull('lease_duration', '>', 0),
                default => $query,
            };
        }

        if ($filters['property_type']) {
            $query->where('type_id', '=', $filters['property_type']);
        }

        if ($filters['min_price'] && $filters['min_price'] !== '') {
            $query->where('price', '>=', $filters['min_price']);
        }

        if ($filters['max_price'] && $filters['max_price'] !== '') {
            $query->where('price', '<=', $filters['max_price']);
        }

        $this->properties = $query
            ->with(['media' => function ($query) {
                $query->orderBy('order_column', 'asc')
                    ->limit(1);
            }])
            ->latest()
            ->get();
    }

    public function sortProperties($order)
    {
        $sortBy = match ($order) {
            'lowestfirst' => 'price',
            'highestfirst' => 'price',
            default => 'created_at',
        };

        $order === 'lowestfirst'
            ? false
            : true;

        $this->properties = collect($this->properties)
            ->sortBy($sortBy, SORT_REGULAR, $order)
            ->values();
    }
}

/**
 * I will eventually have to add pagination here, because as of rn index aciton return all properties from the db.
 * When there ton of properties this will not be acceptable. So this is something I will have to return to.
 */
