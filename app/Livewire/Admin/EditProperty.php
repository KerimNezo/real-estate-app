<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Computed;

class EditProperty extends Component
{
    use WithFileUploads;

    public $property;
    public $oldPhotos = [];
    public $tempPhotos = [];
    public $removedPhotoIds = [];

    #[Validate('required|string|max:255')]
    public $tempTitle;

    #[Validate('nullable|string')]
    public $tempDescription;

    #[Validate('required|exists:users,id')]
    public $tempAgent;

    #[Validate('required')]
    public $tempPrice;

    // Status: Active, Rented, Sold (status)
    #[Validate('required|string')]
    public $tempStatus;

    // Offer For Sale/Rent (lease_duration)
    #[Validate('nullable|string')]
    public $tempOffer;

    #[Validate('image|max:1024')]
    public $newPhotos = []; // Array to handle new uploads

    #[Validate('image|max:1024')]
    public $newPhotoPreviews = []; // Array for previewing newly uploaded photos

    public function mount($property)
    {
        $this->property = $property;
        $this->tempTitle = $property->name;
        $this->tempPrice = $property->price;
        $this->tempDescription = $property->description;
        $this->tempPhotos = $property->getMedia('property-photos');
        $this->oldPhotos = clone $this->tempPhotos;
        $this->tempAgent = $property->user_id;
        $this->tempOffer = $this->property->lease_duration === 'null' ? 'Sale' : 'Rent';
        $this->tempStatus = $this->property->status;
    }

    #[Computed]
    public function agents()
    {
        return User::query()
            ->select('id', 'name')
            ->where('id', '>', 1)
            ->latest()
            ->get();
    }

    public function updatedNewPhotos()
    {
        // Generate temporary URLs for previewing new photos
        foreach ($this->newPhotos as $photo) {
            $this->newPhotoPreviews[] = $photo->temporaryUrl();
        }
    }

    public function removePhoto($index, $id)
    {
        $this->removedPhotoIds[] = $id;
        $this->tempPhotos = $this->tempPhotos->filter(fn ($photo, $i) => $i !== $index)->values();
        foreach ($this->tempPhotos as $i => $photo) {
            $photo->order_column = $i + 1;
        }
    }

    public function resetPhotos()
    {
        $this->tempPhotos = clone $this->oldPhotos;
        $this->removedPhotoIds = [];
        $this->newPhotos = [];
        $this->newPhotoPreviews = [];
    }

    public function reorderPhotos()
    {
        // Fetch the updated media items for the property
        $mediaItems = $this->property->getMedia('property-photos');

        // Update order_column from 1 to N based on the current count
        foreach ($mediaItems as $index => $mediaItem) {
            $mediaItem->order_column = $index + 1; // Set order_column starting from 1
            $mediaItem->save(); // Save the changes
        }
    }

    public function saveProperty()
    {
        logger('usao');

        logger($this->tempOffer);
        logger($this->tempStatus);

        // Update name, description, agent, price
        $this->property->name = $this->tempTitle;
        logger('5');
        $this->property->description = $this->tempDescription;
        logger('4');
        $this->property->user_id = $this->tempAgent;
        logger('3');
        $this->property->price = $this->tempPrice;
        logger('2');
        $this->property->status = $this->tempStatus;
        logger('1');

        if ($this->tempOffer === 'Sale') {
            $this->property->lease_duration = null;
        } elseif ($this->tempOffer === 'Rent') {
            $this->property->lease_duration = 1;
        } else {
            logger('Nešto nije u redu sa statusom');
        }

        // Save new photos to the database
        foreach ($this->newPhotos as $photo) {
            $this->property->addMedia($photo)->toMediaCollection('property-photos');
        }

        // Remove photos marked for deletion
        foreach ($this->removedPhotoIds as $photoId) {
            $mediaItem = $this->property->media()->find($photoId);
            if ($mediaItem) {
                $mediaItem->delete();
            }
        }

        $this->reorderPhotos();

        // Clear new photos and previews after saving
        $this->newPhotos = [];
        $this->newPhotoPreviews = [];
        $this->property->save();

        return $this->redirect(route('admin-properties'));
    }
}
