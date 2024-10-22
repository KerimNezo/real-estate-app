<?php

namespace App\Livewire\Admin;

use App\Models\Property;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithPagination;

class PropertyIndex extends Component
{
    use WithPagination;

    public $minPrice;

    public $maxPrice;

    public $assetTypeId;

    public $assetLocation;

    public $assetOfferId;

    #[Locked]
    public $cities;

    // Have no need for mount() lifecycle hook
    // because Livewire will automatically set the passed values to properties with the same name
    // same as render()

    public function resetForm()
    {
        $this->assetLocation = '';
        $this->assetTypeId = '';
        $this->minPrice = '';
        $this->maxPrice = '';
        $this->assetOfferId = '';
    }

    #[Computed]
    public function properties()
    {
        $prop = Property::query()
            ->select()
            ->latest()
            ->with(['media' => function ($query) {
                $query->orderBy('order_column', 'asc')
                    ->limit(6);
            }, 'user' => function ($userQuery) {
                $userQuery->select('id', 'name');
            }]);

        // Ovdje loadam sve slike, samo 6 ako mu slučajno spasi više, jer šaljemo cijeli property objekat na rutu
        // da ne bih morao queryat ponovo na show-property ruti

        if (! is_null($this->assetLocation) && $this->assetLocation != '') {
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

        if (! is_null($this->assetOfferId)) {
            if ($this->assetOfferId == 3) {
                $prop = $prop->where('status', '=', 'Sold');
            } elseif ($this->assetOfferId == 1) {
                $prop = $prop->where('lease_duration', '=', null);
                $prop = $prop->where('status', '=', 'Available');
            } elseif ($this->assetOfferId == 2) {
                $prop = $prop->where('lease_duration', '!=', null);
                $prop = $prop->where('status', '=', 'Available');
            } else {
            }
        }

        $this->reset(['minPrice', 'maxPrice', 'assetLocation', 'assetTypeId', 'assetOfferId']);

        return $prop->paginate(10);
    }

    public function submitForm()
    {
        logger('Form submitted');
        // this action here will just change the values of component properties, and when those change
        // by default the computed property will update.
    }
}
