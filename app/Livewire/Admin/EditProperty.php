<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

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

    // Function that triggers when new photos are added to the component
    public function updatedNewPhotos()
    {
        foreach ($this->newPhotos as $photo) {
            if ($photo) {
                $this->newPhotoArray[$this->sanitizePhotoName($photo)] = $photo;
            }
        }
    }

    // Function to rename newly added property photos
    public function sanitizePhotoName($photo)
    {
        $nameWithoutExtension = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);

        // This str_replace, right now, just removes spaces. So if some bs comes up in image names, I just need to edit this code here.
        $sanitized = str_replace(' ', '', $nameWithoutExtension);

        return $sanitized;
    }

    // Function that removes new photos added to the component
    public function removeNewPhoto($filename)
    {
        foreach ($this->newPhotoArray as $index => $photo) {
            if ($this->sanitizePhotoName($photo) === $filename) {
                unset($this->newPhotoArray[$filename]);
                break;
            }
        }
    }

    // Function to remove existing property photo from displaying on screen
    public function removePhoto($index, $id)
    {
        // We add the photos id to an array
        $this->removedPhotoIds[] = $id;

        $this->tempPhotos = $this->tempPhotos->filter(fn ($photo) => $photo->id !== $id)->values();
    }

    // Function to reset photo properties so stored property photos are displayed again
    public function resetPhotos()
    {
        $this->tempPhotos = $this->propertyMedia;

        // We clear properties that interact with new and existing photos in component
        $this->reset('newPhotos', 'removedPhotoIds', 'newPhotoArray');
    }

    // Function to reorder property photos so that their order_column values are in asc order with no skipping (relevant for display of photos)
    public function reorderPhotos()
    {
        $mediaItems = $this->property->getMedia('property-photos');

        foreach ($mediaItems as $index => $mediaItem) {
            $mediaItem->order_column = $index + 1;
            $mediaItem->save();
        }
    }

    // Sell/Rent property (button)
    // Function that sets property status as sold/rented and generates dateTime for transaction_at
    public function makeTransaction()
    {
        $this->property->transaction_at = now();
        if ($this->property->lease_duration > 0) {
            $this->property->status = "Rented";

            $this->property->save();

            return redirect()->route('admin-properties')->with('success', 'Property rented successfully.');
        } else {
            $this->property->status = "Sold";

            $this->property->save();

            return redirect()->route('admin-properties')->with('success', 'Property sold successfully.');
        }
    }

    protected function convertToWebp($path)
    {
        logger($path);
        $image = Image::read($path)->toWebp(); // Convert to WebP with 90% quality

        // Save the WebP image to a temporary location
        $webpTempPath = sys_get_temp_dir() . '/' . uniqid() . '.webp';
        $image->save($webpTempPath);

        return $webpTempPath;
    }

    // Update property (button)
    // Function that handles the update of property with new data from the form
    public function saveProperty()
    {
        logger('Before validation');

        // Validating the new data
        $this->validate();

        logger('Validation passed');

        logger('-------------------------------------------------');

        // Assigning models properties with new data
        $this->property->name = $this->tempTitle;
        $this->property->description = $this->tempDescription;
        $this->property->user_id = $this->tempAgent;
        $this->property->price = $this->tempPrice;
        $this->property->status = $this->tempStatus;

        // Setting and assigning property lease_duration based on offer entered in form
        if ($this->tempOffer === 'Sale') {
            $this->property->lease_duration = 0;
        } elseif ($this->tempOffer === 'Rent') {
            $this->property->lease_duration = 1;
        } else {
            logger("Something's wrong with the status");
        }

        // Adding new photos to properties mediaCollection
        foreach ($this->newPhotoArray as $key => $photo) {
            // Convert the uploaded photo to WebP format
            $webpFilePath = $this->convertToWebp($photo->getRealPath());

            $this->property->addMedia($webpFilePath)->toMediaCollection('property-photos');
        }

        // Removing photos stored in db
        foreach ($this->removedPhotoIds as $photoId) {
            $mediaItem = $this->property->media()->find($photoId);
            if ($mediaItem) {
                $mediaItem->delete();
            }
        }

        // Reordering photos left in mediaCollection so their order_column are in asc order
        $this->reorderPhotos();

        $this->property->save();

        if(Auth::user()->hasRole('agent')) {
            return redirect()->route('agent-properties')->with('success', 'Property edited successfully.');
        } else {
            return redirect()->route('admin-properties')->with('success', 'Property edited successfully.');
        }
    }
}
