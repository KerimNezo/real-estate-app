<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

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

    // Array to handle new uploads
    #[Validate('nullable|max:1024')]
    public $newPhotos = [];

    // Array to handle key=>value pair of newly added photos and their id's
    public $newPhotoArray = [];

    public function mount($property)
    {
        $this->property = $property;
        $this->tempTitle = $property->name;
        $this->tempPrice = $property->price;
        $this->tempDescription = $property->description;
        $this->tempPhotos = $this->propertyMedia;
        $this->tempAgent = $property->user_id;
        $this->tempOffer = $this->property->lease_duration === null || $this->property->lease_duration === 0 ? 'Sale' : 'Rent';
        $this->tempStatus = $this->property->status;
    }

    #[Computed]
    public function agents()
    {
        return User::query()
            ->select('id', 'name')
            ->where('id', '!=', 1)
            ->latest()
            ->get();
    }

    public function updatedNewPhotos()
    {
        foreach ($this->newPhotos as $photo) {
            if ($photo) {
                $this->newPhotoArray[$this->sanitizePhotoName($photo)] = $photo;
            }
        }
    }

    public function sanitizePhotoName($photo)
    {
        $nameWithoutExtension = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);

        // This str_replace, right now, just removes spaces. So if some bs comes up in image names, I just need to edit this code here.
        $sanitized = str_replace(' ', '', $nameWithoutExtension);

        return $sanitized;
    }

    public function removeNewPhoto($filename)
    {
        foreach ($this->newPhotoArray as $index => $photo) {
            if ($this->sanitizePhotoName($photo) === $filename) {
                unset($this->newPhotoArray[$filename]);
                break;
            }
        }
    }

    public function removePhoto($index, $id)
    {
        $this->removedPhotoIds[] = $id;

        $this->tempPhotos = $this->tempPhotos->filter(fn ($photo) => $photo->id !== $id)->values();

        logger("index: $index");
        logger("Id: $id");
    }

    public function resetPhotos()
    {
        $this->tempPhotos = $this->propertyMedia;
        $this->reset('newPhotos', 'removedPhotoIds', 'newPhotoArray');
    }

    // Main usage of the function is to reorder property photos so that their order_column values are in sync
    public function reorderPhotos()
    {
        $mediaItems = $this->property->getMedia('property-photos');

        foreach ($mediaItems as $index => $mediaItem) {
            $mediaItem->order_column = $index + 1;
            $mediaItem->save();
        }
    }

    public function saveProperty()
    {
        logger('Before validation');

        $this->validate();

        logger('Validation passed');

        logger('-------------------------------------------------');

        $this->property->name = $this->tempTitle;
        $this->property->description = $this->tempDescription;
        $this->property->user_id = $this->tempAgent;
        $this->property->price = $this->tempPrice;
        $this->property->status = $this->tempStatus;

        if ($this->tempOffer === 'Sale') {
            $this->property->lease_duration = 0;
        } elseif ($this->tempOffer === 'Rent') {
            $this->property->lease_duration = 1;
        } else {
            logger("Something's wrong with the status");
        }

        foreach ($this->newPhotoArray as $key => $photo) {
            $this->property->addMedia($photo)->toMediaCollection('property-photos');
        }

        foreach ($this->removedPhotoIds as $photoId) {
            $mediaItem = $this->property->media()->find($photoId);
            if ($mediaItem) {
                $mediaItem->delete();
            }
        }

        $this->reorderPhotos();

        $this->property->save();

        return redirect()->route('admin-properties')->with('success', 'Property edited successfully.');
    }
}
