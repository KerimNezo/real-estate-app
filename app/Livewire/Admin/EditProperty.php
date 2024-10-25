<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Computed;

use App\Models\User;

class EditProperty extends Component
{
    use WithFileUploads;

    public $property;

    #[Computed]
    public function agents()
    {
        $agent = User::query()
        ->select('id', 'name')
        ->where('id','>', 1)
        ->latest();

        return $agent->get();
    }

    public $tempPhotos = [];
    public $removedPhotoIds = [];
    public $tempTitle;
    public $tempDescription;
    public $tempAgent;

    public function mount($property)
    {
        $this->property = $property;
        $this->tempTitle = $property->title;
        $this->tempDescription = $property->description;
        $this->tempPhotos = $property->getMedia('property-photos');
        $this->tempAgent = $property->user->id;
    }

    public function removePhoto($index, $id)
    {
        $this->removedPhotoIds[] = $id;
        logger($this->removedPhotoIds);

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
        $this->tempPhotos = $this->property->getMedia('property-photos');
        $this->removedPhotoIds = [];
    }
}
