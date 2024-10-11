<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Property;
use Livewire\WithPagination;

class PropertyIndex extends Component
{
    use WithPagination;

    public $minPrice;
    public $maxPrice;
    public $assetTypeId;
    public $assetLocation;

    public function mount($assetLocation = null, $minPrice = null, $maxPrice = null, $assetTypeId = null)
    {
        $this->assetLocation = $assetLocation;
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;
        $this->assetTypeId = $assetTypeId;
    }

    #[Computed]
    public function properties()
    {
        $prop = Property::query()
            ->select('user_id', 'id', 'type_id', 'name', 'price', 'city', 'lease_duration', 'year_built')
            ->latest()
            ->with(['media' => function ($query) {
                $query->orderBy('order_column', 'asc')
                    ->limit(1);
            }, 'user']);

        if (! is_null($this->assetLocation)) {
            $prop = $prop->where('city', '=', $this->assetLocation);
        }

        if (! is_null($this->assetTypeId) && $this->assetTypeId > 0) {
            $prop = $prop->where('type_id', '=', $this->assetTypeId);
        }

        if (! is_null($this->minPrice)) {
            $prop = $prop->where('price', '>', $this->minPrice);
        }

        if (! is_null($this->maxPrice)) {
            $prop = $prop->where('price', '<', $this->maxPrice);
        }

        return $prop->paginate(10);
    }
}
