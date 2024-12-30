<?php

namespace App\Livewire\Admin;

use App\Models\Property;
use Illuminate\Support\Facades\Auth;
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
            ->withTrashed()
            ->select()
            ->latest()
            ->with(['media' => function ($query) {
                $query->orderBy('order_column', 'asc')
                    ->limit(1);
            }, 'user' => function ($userQuery) {
                $userQuery->select('id', 'name');
            }]);

        // Ovdje loadam sve slike, samo 6 ako mu slučajno spasi više, jer šaljemo cijeli property objekat na rutu
        // da ne bih morao queryat ponovo na show-property ruti

        logger('Max price je '.$this->maxPrice);

        if (! is_null($this->assetLocation) && $this->assetLocation != '') {
            $prop = $prop->where('city', '=', $this->assetLocation);
        }

        if (! is_null($this->assetTypeId) && $this->assetTypeId > 0) {
            $prop = $prop->where('type_id', '=', $this->assetTypeId);
        }

        if ($this->minPrice !== null && $this->minPrice !== '') {
            $prop = $prop->where('price', '>', $this->minPrice);
        }

        if ($this->maxPrice !== null && $this->maxPrice !== '') {
            $prop = $prop->where('price', '<', $this->maxPrice);
        }

        if (!is_null($this->assetOfferId)) {
            if ($this->assetOfferId == 1) {
                $prop = $prop->where(function ($query) {
                    $query->where('lease_duration', '=', 0)
                          ->orWhere('lease_duration', null);
                });
            } elseif ($this->assetOfferId == 2) {
                $prop = $prop->where('lease_duration', '>', 0);
            }
        }

        /**
         * WHERE status = 'Available'
           AND lease_duration = 0
           OR lease_duration IS NULL;

           Ovako bi izgledao sql query koji smo napravili gore bili, bez grupisanja where i orWhere klauzi, što u biti znaci status available i lease 0 ILI lease null
           Sto nije ono što želimo. Ovako kada grupišeš where i orWhere klauze, dobiješ status available ILI (lease 0 ili lease null) što želimo.
         */

        // Added this to check if agent is using this class, to only display him available properties
        if (Auth::user()->hasRole('agent')) {
            $prop = $prop->where('status', '=', 'Available');
        }

        $this->reset(['minPrice', 'maxPrice', 'assetLocation', 'assetTypeId', 'assetOfferId']);

        return $prop->paginate(10);
    }

    public function submitForm()
    {
        $this->resetPage();
        logger('Form submitted');
        // this action here will just change the values of component properties, and when those change
        // by default the computed property will update.
    }
}
