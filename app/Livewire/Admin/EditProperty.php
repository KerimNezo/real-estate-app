<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Computed;

class EditProperty extends Component
{
    use WithFileUploads;

    public $property;

    #[Locked]
    public $propertyMedia = [];
    public $tempPhotos = [];
    public $removedPhotoIds = [];

    #[Validate('required|string|max:50', message: 'Maximum name size is 50 characters')]
    public $tempTitle;

    #[Validate('nullable|string|max:550', message: 'Maximum description size is 550 characters')]
    public $tempDescription;

    #[Validate('required|exists:users,id', message: 'Ne radi agent')]
    public $tempAgent;

    #[Validate('required|numeric', message: 'Please enter a number')]
    public $tempPrice;

    // Status: Active, Rented, Sold (status)
    #[Validate('required|string|in:Available,Unavailable', message: 'Status value is not accepted')]
    public $tempStatus;

    // Offer For Sale/Rent (lease_duration)
    #[Validate('required|string|in:Sale,Rent', message: 'Offer value is not accepted')]
    public $tempOffer;

    #[Validate('nullable|max:1024')]
    public $newPhotos = []; // Array to handle new uploads

    public function mount($property)
    {
        $this->property = $property;
        $this->tempTitle = $property->name;
        $this->tempPrice = $property->price;
        $this->tempDescription = $property->description;
        $this->tempPhotos = $this->propertyMedia;
        $this->tempAgent = $property->user_id;
        $this->tempOffer = $this->property->lease_duration === null ? 'Sale' : 'Rent';
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
            logger('ALOOO');
            logger($photo->getcreateFromLivewire());
        }
    }

    public function removeNewPhoto($filename)
    {
        logger($filename);

        // Filter out the photo based on its unique id instead of the index
        $this->newPhotos = $this->newPhotos->filter(fn($photo) => $photo->temporaryUrl() !== $filename)->values();
    }

    public function removePhoto($index, $id)
    {
        // Add the ID to the removed list
        $this->removedPhotoIds[] = $id;

        logger($id);

        // Filter out the photo based on its unique id instead of the index
        $this->tempPhotos = $this->tempPhotos->filter(fn($photo) => $photo->id !== $id)->values();

        logger("index: $index");
        logger("Id: $id");
    }

    public function resetPhotos()
    {
        $this->tempPhotos = $this->propertyMedia;
        $this->reset('newPhotos', 'removedPhotoIds');
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

        logger('Before validation');

        $this->validate();

        logger('Validation passed');

        logger('-------------------------------------------------');

        // Update name, description, agent, price
        $this->property->name = $this->tempTitle;
        $this->property->description = $this->tempDescription;
        $this->property->user_id = $this->tempAgent;
        $this->property->price = $this->tempPrice;
        $this->property->status = $this->tempStatus;

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
        $this->property->save();

        return $this->redirect(route('admin-properties'));
    }
}
