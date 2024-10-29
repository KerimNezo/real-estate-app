<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Computed;
use App\Models\User;
use App\Models\Property;

class EditProperty extends Component
{
    use WithFileUploads;

    public $property;
    public $oldPhotos = [];
    public $tempPhotos = [];
    public $removedPhotoIds = [];
    public $tempTitle;
    public $tempDescription;
    public $tempAgent;

    public $newPhotos = []; // Array to handle new uploads
    public $newPhotoPreviews = []; // Array for previewing newly uploaded photos

    #[Computed]
    public function agents()
    {
        $agent = User::query()
            ->select('id', 'name')
            ->where('id', '>', 1)
            ->latest();

        return $agent->get();
    }

    public function mount($property)
    {
        // Property
        $this->property = $property;
        $this->tempTitle = $property->title;
        $this->tempDescription = $property->description;
        // Property pictures that are stored in DB
        $this->tempPhotos = $property->getMedia('property-photos');
        // Property pictures that are stored in DB (variable will be used to reset the property photos)
        $this->oldPhotos = clone $this->tempPhotos;
        // Temporary Agent loaded from DB
        $this->tempAgent = $property->user_id;
    }

    public function updatedNewPhotos()
    {
        // Generate temporary URLs for previewing new photos
        foreach ($this->newPhotos as $photo) {
            $this->newPhotoPreviews[] = $photo->temporaryUrl();
        }

        logger($this->newPhotoPreviews);
    }

    public function removePhoto($index, $id)
    {
        $this->removedPhotoIds[] = $id;

        // Remove the media item from the collection
        $this->tempPhotos = $this->tempPhotos->filter(function ($photo, $i) use ($index) {
            return $i !== $index;
        })->values();

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

    public function saveProperty()
    {
        // Save new photos to the database
        foreach ($this->newPhotos as $photo) {
            $this->property->addMedia($photo)->toMediaCollection('property-photos');
        }

        // Remove any photos marked for deletion from the database
        foreach ($this->removedPhotoIds as $photoId) {
            $mediaItem = $this->property->media()->find($photoId);
            if ($mediaItem) {
                $mediaItem->delete();
            }
        }

        // Reset new photos and previews after saving
        $this->newPhotos = [];
        $this->newPhotoPreviews = [];

        // Update other property fields if needed
        $this->property->title = $this->tempTitle;
        $this->property->description = $this->tempDescription;
        $this->property->user_id = $this->tempAgent;
        $this->property->save();
    }
}
