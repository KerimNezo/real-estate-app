<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class EditProperty extends Component
{

    public $property;

    public $propertyPhotos;

    public $oldPhotos;

    public function mount()
    {
        $this->propertyPhotos = $this->property->getMedia('property-photos');
        $this->oldPhotos = clone $this->propertyPhotos;
    }

    public function removePhoto($index)
    {
        // Get the media item to be removed
        $mediaToRemove = $this->propertyPhotos[$index];

        // Delete the media item from the database
        $mediaToRemove->delete();

        // Remove the media item from the collection
        $this->propertyPhotos = $this->propertyPhotos->filter(function ($photo, $i) use ($index) {
            return $i !== $index;
        })->values(); // Reset the array keys

        // Reset order_column for the remaining photos
        foreach ($this->propertyPhotos as $i => $photo) {
            $photo->order_column = $i + 1;
            $photo->save(); // Persist the new order
        }
    }

    public function resetPhotos()
    {
        $this->propertyPhotos = clone $this->oldPhotos;
    }


}
