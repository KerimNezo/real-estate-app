<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Property;

class StoreProperty extends Component
{
    use WithFileUploads;

    #[Validate]
    public $media = [];
    // ovo (#[Validate]) generalno ne moramo koristiti ako koristimo rules() validation() funkcije.
    // onda možemo tu sva pravila i poruke napisati, i vršiti validaciju preko $this->validate()
    // ali ako nemamo #[Validate] onda ne možemo koristiti live validaciju. tako da stoji ovdje da imamo live validaciju koju postavljamo na inpute preko wire:model.blur
    // .blur čeka da user tab outa od inputa i onda radi validaciju
    // .live validira kako korisnik unosi podatke

    // Ako ćeš koristiti ovo, moraš ovo da koristiš wire:model.blur="", tj real-time validation
    #[Validate]
    public $propertyData = [
        'user_id' => null,
        'type_id' => null,
        'name' => null,
        'price' => null,
        'surface' => null,
        'lat' => null,
        'lon' => null,
        'room' => null,
        'toilets' => null,
        'bedrooms' => null,
        'garage' => null,
        'furnished' => null,
        'floors' => null,
        'lease_duration' => null,
        'video_intercom' => null,
        'keycard_entry' => null,
        'elevator' => null,
        'city' => null,
        'street' => null,
        'country' => null,
        'description' => null,
        'year_built' => null,
        'garden' => null,
        'status' => null,
    ];

    public function resetData() {
        $this->propertyData = array_fill_keys(array_keys($this->propertyData), null);
        $this->reset('media');
    }

    public function removePhoto() {
        // This funciton will remove tempPhoto from the $this->media property
    }

    // Don't know if I will need a function to handle map behaviour

    // Provjeri i ovo
    public function rules()
    {
        return [
            'propertyData.user_id' => 'required|integer',
            'propertyData.type_id' => 'required|integer',
            'propertyData.name' => 'required|string|max:255',
            'propertyData.price' => 'required|numeric|min:0',
            'propertyData.surface' => 'nullable|numeric',
            'propertyData.lat' => 'nullable|numeric',
            'propertyData.lon' => 'nullable|numeric',
            'propertyData.room' => 'nullable|integer',
            'propertyData.toilets' => 'nullable|integer',
            'propertyData.bedrooms' => 'nullable|integer',
            'propertyData.garage' => 'nullable|integer',
            'propertyData.furnished' => 'nullable|boolean',
            'propertyData.floors' => 'nullable|integer',
            'propertyData.lease_duration' => 'nullable|string',
            'propertyData.video_intercom' => 'nullable|boolean',
            'propertyData.keycard_entry' => 'nullable|boolean',
            'propertyData.elevator' => 'nullable|boolean',
            'propertyData.city' => 'nullable|string|max:255',
            'propertyData.street' => 'nullable|string|max:255',
            'propertyData.country' => 'nullable|string|max:255',
            'propertyData.description' => 'nullable|string',
            'propertyData.year_built' => 'nullable|integer',
            'propertyData.garden' => 'nullable|boolean',
            'propertyData.status' => 'nullable|string',
            'media' => 'nullable|image|max:1024',
        ];
    }

    // Provjeri i ovo
    public function messages()
    {
        return [
            'propertyData.name.required' => 'The property name is required.',
            'propertyData.name.string' => 'The property name must be a string.',
            'propertyData.name.max' => 'The property name cannot exceed 255 characters.',

            'propertyData.price.required' => 'The price is required.',
            'propertyData.price.numeric' => 'The price must be a valid number.',
            'propertyData.price.min' => 'The price must be at least 0.',

            'propertyData.user_id.required' => 'The user ID is required.',
            'propertyData.user_id.integer' => 'The user ID must be an integer.',

            'propertyData.type_id.required' => 'The type ID is required.',
            'propertyData.type_id.integer' => 'The type ID must be an integer.',

            'media.image' => 'The uploaded file must be an image.',
            'media.max' => 'The image size cannot exceed 1MB.',

            'propertyData.city.string' => 'The city name must be a string.',
            'propertyData.city.max' => 'The city name cannot exceed 255 characters.',

            'propertyData.street.string' => 'The street name must be a string.',
            'propertyData.street.max' => 'The street name cannot exceed 255 characters.',

            'propertyData.country.string' => 'The country name must be a string.',
            'propertyData.country.max' => 'The country name cannot exceed 255 characters.',

            'propertyData.surface.numeric' => 'The surface area must be a valid number.',

            'propertyData.lat.numeric' => 'The latitude must be a valid number.',

            'propertyData.lon.numeric' => 'The longitude must be a valid number.',

            'propertyData.room.integer' => 'The number of rooms must be an integer.',

            'propertyData.toilets.integer' => 'The number of toilets must be an integer.',

            'propertyData.bedrooms.integer' => 'The number of bedrooms must be an integer.',

            'propertyData.garage.integer' => 'The number of garages must be an integer.',

            'propertyData.furnished.boolean' => 'The furnished field must be true or false.',

            'propertyData.floors.integer' => 'The number of floors must be an integer.',

            'propertyData.lease_duration.string' => 'The lease duration must be a string.',

            'propertyData.video_intercom.boolean' => 'The video intercom field must be true or false.',

            'propertyData.keycard_entry.boolean' => 'The keycard entry field must be true or false.',

            'propertyData.elevator.boolean' => 'The elevator field must be true or false.',

            'propertyData.description.string' => 'The description must be a string.',

            'propertyData.year_built.integer' => 'The year built must be an integer.',

            'propertyData.garden.boolean' => 'The garden field must be true or false.',

            'propertyData.status.string' => 'The status must be a string.',
        ];
    }


    public function storeProperty() {
        logger('>---------------------------------------------<');

        logger('Before validation');

        $this->validate();

        logger('Validation passed');

        $property = new Property();

        $property->status = "Available";
        $property->save();

        return redirect()->route('all-properties')->with('success', 'Property created successfully.');
    }
}
