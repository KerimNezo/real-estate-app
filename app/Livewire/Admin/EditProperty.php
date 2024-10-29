<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Livewire\Attributes\Computed;

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
    public $tempPrice;
    public $newPhotos = []; // Array to handle new uploads
    public $newPhotoPreviews = []; // Array for previewing newly uploaded photos

    protected $rules = [
        'tempTitle' => 'required|string|max:255',
        'tempDescription' => 'nullable|string',
        'tempPrice' => 'required|number',
        'tempAgent' => 'required|exists:users,id',
        'newPhotos.*' => 'image|max:1024' // 1MB max per photo
    ];

    public function mount($property)
    {
        $this->property = $property;
        $this->tempTitle = $property->name;
        $this->tempPrice = $property->price;
        $this->tempDescription = $property->description;
        $this->tempPhotos = $property->getMedia('property-photos');
        $this->oldPhotos = clone $this->tempPhotos;
        $this->tempAgent = $property->user_id;
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

    public function saveProperty()
    {
        $this->validate();

        // Update title, description, and agent
        $this->property->name = $this->tempTitle;
        $this->property->description = $this->tempDescription;
        $this->property->user_id = $this->tempAgent;
        $this->property->price = $this->tempPrice;

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

        // Clear new photos and previews after saving
        $this->newPhotos = [];
        $this->newPhotoPreviews = [];
        $this->property->save();

        // Emit a success message
        $this->dispatchBrowserEvent('notification', [
            'message' => 'Property updated successfully!',
            'type' => 'success'
        ]);
    }
}
