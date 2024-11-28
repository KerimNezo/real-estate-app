<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Models\User;
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
    public $user_id, $type_id, $name, $price, $surface, $lat, $lon, $rooms, $toilets, $bedrooms, $garage, $furnished, $floors, $lease_duration, $video_intercom, $keycard_entry, $elevator, $city, $street, $country, $description, $year_built, $garden, $status = null;

    #[Computed]
    public function agents()
    {
        return User::query()
            ->select('id', 'name')
            ->where('id', '!=', 1)
            ->latest()
            ->get();
    }

    public function resetData() {
        // dodje ovdje ispod ostale podatke
        $this->reset('media');
    }

    public function removePhoto() {
        // This funciton will remove tempPhoto from the $this->media property
    }

    // Provjeri i ovo
    public function rules()
    {
        return [
            'user_id' => 'required|integer',
            'type_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'surface' => 'required|numeric',
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
            'rooms' => 'nullable|integer|min:0',
            'toilets' => 'nullable|integer',
            'bedrooms' => 'nullable|integer',
            'garage' => 'nullable|integer',
            'furnished' => 'nullable|boolean',
            'floors' => 'nullable|integer',
            'lease_duration' => 'required|string',
            'video_intercom' => 'nullable|boolean',
            'keycard_entry' => 'nullable|boolean',
            'elevator' => 'nullable|boolean',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'description' => 'required|string',
            'year_built' => 'required|integer',
            'garden' => 'nullable|boolean',
            'status' => 'required|string',
            'media' => 'nullable|image|max:1024',
        ];
    }

    // Validation rule messages for each property
    public function messages()
    {
        return [
            'name.required' => 'The property name is required.',
            'name.string' => 'The property name must be a string.',
            'name.max' => 'The property name cannot exceed 255 characters.',

            'price.required' => 'The price is required.',
            'price.numeric' => 'The price must be a valid number.',
            'price.min' => 'The price must be at least 0.',

            'user_id.required' => 'The user ID is required.',
            'user_id.integer' => 'The user ID must be an integer.',

            'type_id.required' => 'The type ID is required.',
            'type_id.integer' => 'The type ID must be an integer.',

            'media.image' => 'The uploaded file must be an image.',
            'media.max' => 'The image size cannot exceed 1MB.',

            'city.string' => 'The city name must be a string.',
            'city.max' => 'The city name cannot exceed 255 characters.',

            'street.string' => 'The street name must be a string.',
            'street.max' => 'The street name cannot exceed 255 characters.',

            'country.required' => 'Please pick property location on map',
            'country.max' => 'The country name cannot exceed 255 characters.',

            'surface.numeric' => 'The surface area must be a valid number.',

            'lat.numeric' => 'The latitude must be a valid number.',

            'lon.numeric' => 'The longitude must be a valid number.',

            'rooms.integer' => 'The number of rooms must be an whole number.',

            'toilets.integer' => 'The number of toilets must be an integer.',

            'bedrooms.integer' => 'The number of bedrooms must be an integer.',

            'garage.integer' => 'The number of garages must be an integer.',

            'furnished.boolean' => 'The furnished field must be true or false.',

            'floors.integer' => 'The number of floors must be an integer.',

            'lease_duration.string' => 'The lease duration must be a string.',

            'video_intercom.boolean' => 'The video intercom field must be true or false.',

            'keycard_entry.boolean' => 'The keycard entry field must be true or false.',

            'elevator.boolean' => 'The elevator field must be true or false.',

            'description.string' => 'The description must be a string.',

            'year_built.integer' => 'The year built must be an integer.',

            'garden.boolean' => 'The garden field must be true or false.',

            'status.string' => 'The status must be a string.',
        ];
    }

    #[On('update-location-data')]
    public function updateLocationData($city, $street, $lat, $lon, $country) {
        $this->street = $street;
        $this->city = $city;
        $this->country = $country;
        $this->lat = $lat;
        $this->lon = $lon;
    }

    public function storeProperty() {
        logger('>---------------------------------------------<');

        logger('Before validation');

        $this->validate();

        logger('Validation passed');

        logger('user_id: ' . $this->user_id);
        logger('type_id: ' . $this->type_id);
        logger('name: ' . $this->name);
        logger('price: ' . $this->price);
        logger('surface: ' . $this->surface);
        logger('lat: ' . $this->lat);
        logger('lon: ' . $this->lon);
        logger('rooms: ' . $this->rooms);
        logger('toilets: ' . $this->toilets);
        logger('bedrooms: ' . $this->bedrooms);
        logger('garage: ' . $this->garage);
        logger('furnished: ' . $this->furnished);
        logger('floors: ' . $this->floors);
        logger('lease_duration: ' . $this->lease_duration);
        logger('video_intercom: ' . $this->video_intercom);
        logger('keycard_entry: ' . $this->keycard_entry);
        logger('elevator: ' . $this->elevator);
        logger('city: ' . $this->city);
        logger('street: ' . $this->street);
        logger('country: ' . $this->country);
        logger('description: ' . $this->description);
        logger('year_built: ' . $this->year_built);
        logger('garden: ' . $this->garden);
        logger('status: ' . $this->status);

        // $property = new Property();

        // $property->status = "Available";
        // $property->save();

        // return redirect()->route('all-properties')->with('success', 'Property created successfully.');
    }
}
