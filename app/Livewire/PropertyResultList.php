<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class PropertyResultList extends Component
{
    use WithPagination;

    public $filters = [
        'location' => null,
        'offer_type' => null,
        'property_type' => null,
        'min_price' => null,
        'max_price' => null,
        'sort' => 'created_at',
    ];

    #[On('form-submitted')]
    public function updateFilters($filters) 
    {
        $this->resetPage();
        $this->filters = $filters;
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    #[Computed]
    public function properties()
    {
        $query = Property::query()
            ->select('id', 'type_id', 'name', 'price', 'city', 'bedrooms', 'garage', 'furnished', 'floors', 'lease_duration', 'keycard_entry', 'surface', 'toilets')
            ->where('status', '=', 'Available')
            ->with(['media' => function ($query) {
                $query->orderBy('order_column', 'asc')
                    ->limit(1);
            }]);

        if ($this->filters['location']) {
            $query->where('city', '=', $this->filters['location']);
        }

        if ($this->filters['offer_type']) {
            $query = match ($this->filters['offer_type']) {
                '1' => $query = $query->where(function ($leaseQuery) {
                            $leaseQuery->where('lease_duration', '=', 0)
                                ->orWhere('lease_duration', null);
                        }),
                '2' => $query->where('lease_duration', '>', 0)
            };
        }

        if ($this->filters['property_type']) {
            $query->where('type_id', '=', $this->filters['property_type']);
        }

        if ($this->filters['min_price'] && $this->filters['min_price'] !== '') {
            $query->where('price', '>=', $this->filters['min_price']);
        }

        if ($this->filters['max_price'] && $this->filters['max_price'] !== '') {
            $query->where('price', '<=', $this->filters['max_price']);
        }

        if ($this->filters['sort'] && $this->filters['sort'] !== '') {
            if ($this->filters['sort'] === 'created_at') {
                $query->orderBy($this->filters['sort']);
            } else {
                if ($this->filters['sort'] === 'highestfirst') {
                    $query->orderBy('price', 'desc');
                } else {
                    $query->orderBy('price', 'asc');
                }
            }
        }

        return $query->paginate(8);
    }
}