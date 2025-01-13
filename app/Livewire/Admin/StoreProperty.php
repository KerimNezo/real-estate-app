<?php

namespace App\Livewire\Admin;

use App\Models\Property;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class StoreProperty extends Component
{
    use WithFileUploads;

    public $allowedMimeTypes = [
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/webp',
        'image/svg+xml',
        'image/bmp',
        'image/tiff',
        'image/heic',
        'image/heif',
    ];

    #[Validate]
    public $media = [];

    public $mediaArray = [];
    // ovo (#[Validate]) generalno ne moramo koristiti ako koristimo rules() validation() funkcije.
    // onda možemo tu sva pravila i poruke napisati, i vršiti validaciju preko $this->validate()
    // ali ako nemamo #[Validate] onda ne možemo koristiti live validaciju. tako da stoji ovdje da imamo live validaciju koju postavljamo na inpute preko wire:model.blur
    // .blur čeka da user tab outa od inputa i onda radi validaciju
    // .live validira kako korisnik unosi podatke

    public function removeNewPhoto($filename)
    {
        foreach ($this->mediaArray as $index => $photo) {
            if ($this->sanitizePhotoName($photo) === $filename) {
                unset($this->mediaArray[$filename]);
                break;
            }
        }
    }

    public function updatedMedia()
    {
        foreach ($this->media as $key => $photo) {
            logger('key. '.$key.', photo: '.$photo);

            // Extract the MIME type from the image info
            $mimeType = $photo->getMimeType();
            logger($mimeType);

            if (in_array($mimeType, $this->allowedMimeTypes, true)) {
                if ($photo) {
                    // Mislim da ti je ovdje error, po načinu na koji storeas slike ovdje u mediaArray
                    $this->mediaArray[$this->sanitizePhotoName($photo)] = $photo;
                    logger('photo name: '.$this->sanitizePhotoName($photo));
                }
            } else {
                $naziv = $this->sanitizePhotoName($photo); // i dodaj file extenziju ovdje
                unset($this->media[$key]);
                session()->flash('notImage', $naziv);
            }
        }
    }

    public function clearFlashMessage()
    {
        session()->forget('notImage');
    }

    public function sanitizePhotoName($photo)
    {
        $nameWithoutExtension = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);

        // This str_replace, right now, just removes spaces. So if some bs comes up in image names, I just need to edit this code here.
        $sanitized = str_replace(' ', '', $nameWithoutExtension);

        return $sanitized;
    }

    public function reorderPhotos($mediaItems)
    {
        foreach ($mediaItems as $index => $mediaItem) {
            $mediaItem->order_column = $index + 1;
            $mediaItem->save();
        }
    }

    public function resetPhotos()
    {
        $this->reset('mediaArray', 'media');
    }

    // pint made them all go into each separate row... Not bothered enought to fix pint, if I can...
    // Ako ćeš koristiti ovo, moraš ovo da koristiš wire:model.blur="", tj real-time validation
    #[Validate]
    public $user_id;

    #[Validate]
    public $type_id;

    #[Validate]
    public $name;

    #[Validate]
    public $price;

    #[Validate]
    public $surface;

    #[Validate]
    public $lat;

    #[Validate]
    public $lon;

    #[Validate]
    public $rooms;

    #[Validate]
    public $toilets;

    #[Validate]
    public $bedrooms;

    #[Validate]
    public $garage;

    #[Validate]
    public $furnished;

    #[Validate]
    public $floors;

    #[Validate]
    public $lease_duration;

    #[Validate]
    public $video_intercom;

    #[Validate]
    public $keycard_entry;

    #[Validate]
    public $elevator;

    #[Validate]
    public $city;

    #[Validate]
    public $street;

    #[Validate]
    public $country;

    #[Validate]
    public $description;

    #[Validate]
    public $year_built;

    #[Validate]
    public $garden;

    #[Validate]
    public $status = null;

    #[Computed]
    public function agents()
    {
        return User::query()
            ->select('id', 'name')
            ->where('id', '!=', 1)
            ->latest()
            ->get();
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
            'rooms' => 'required|integer|min:0',
            'toilets' => 'required|integer',
            'bedrooms' => 'required|integer',
            'floors' => 'required|integer',
            'lease_duration' => 'required|string',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'year_built' => 'required|integer',
            'garage' => 'nullable|integer',
            'furnished' => 'nullable|boolean',
            'video_intercom' => 'nullable|boolean',
            'keycard_entry' => 'nullable|boolean',
            'elevator' => 'nullable|boolean',
            'garden' => 'nullable|boolean',
            'media' => 'nullable|max:1024',
        ];
    }

    // Validation rule messages for each property
    public function messages()
    {
        return [
            // Main inputs messages

            'name.required' => 'Property name is required.',
            'name.string' => 'The property name must be a string.',
            'name.max' => 'The property name cannot exceed 255 characters.',

            'price.required' => 'Property price is required.',
            'price.numeric' => 'The price must be a valid number.',
            'price.min' => 'The price must be at least 0.',

            'user_id.required' => 'Choosing an agent is required.',
            'user_id.integer' => 'The user ID must be an integer.',

            'type_id.required' => 'Choosing a property type is required.',
            'type_id.integer' => 'The type ID must be an integer.',

            'year_built.string' => 'Property year of building is required.',
            'year_built.integer' => 'The year built must be an integer.',

            'lease_duration.required' => 'Property offer type is required.',
            'lease_duration.string' => 'The lease duration must be a string.',

            // Location and desc messages

            'description.required' => 'Property description is required',
            'description.max' => 'Description can not be longer than 500 characters.',
            'description.string' => 'The description must be a string.',

            'city.required' => 'Property city name is required.',
            'city.string' => 'The city name must be a string.',
            'city.max' => 'The city name cannot exceed 255 characters.',

            'street.required' => 'Property street name is required',
            'street.string' => 'The street name must be a string.',
            'street.max' => 'The street name cannot exceed 255 characters.',

            'country.required' => 'Please pick property location on map',
            'country.max' => 'The country name cannot exceed 255 characters.',

            'lat.required' => 'Property latitude is required.',
            'lat.numeric' => 'The latitude must be a valid number.',

            'lon.required' => 'Property longitude is required.',
            'lon.numeric' => 'The longitude must be a valid number.',

            // Number input messages

            'rooms.required' => 'Number of rooms is required',
            'rooms.integer' => 'The number of rooms must be an whole number.',

            'toilets.required' => 'Number of toilets is required',
            'toilets.integer' => 'The number of toilets must be an integer.',

            'bedrooms.required' => 'Number of bedrooms is required',
            'bedrooms.integer' => 'The number of bedrooms must be an integer.',

            'floors.required' => 'Number of floors is required',
            'floors.integer' => 'The number of floors must be an integer.',

            'surface.required' => 'Property surface area is required.',
            'surface.numeric' => 'The surface area must be a valid number.',

            // Checkbox input messages

            'garage.integer' => 'The number of garages must be an integer.',

            'furnished.boolean' => 'The furnished field must be true or false.',

            'video_intercom.boolean' => 'The video intercom field must be true or false.',

            'keycard_entry.boolean' => 'The keycard entry field must be true or false.',

            'elevator.boolean' => 'The elevator field must be true or false.',

            'garden.boolean' => 'The garden field must be true or false.',
        ];
    }

    #[On('update-location-data')]
    public function updateLocationData($city, $street, $lat, $lon, $country)
    {
        $this->street = $street;
        $this->city = $city;
        $this->country = $country;
        $this->lat = $lat;
        $this->lon = $lon;
        logger('lat: '.$this->lat);
        logger('lon: '.$this->lon);
        logger('city: '.$this->city);
        logger('street: '.$this->street);
        logger('country: '.$this->country);

        if($this->city) {
            $this->resetErrorBag(['city']);
        } else {
            $this->city = null;
        }

        if($this->street) {
            $this->resetErrorBag(['street']);
        } else {
            $this->street = null;
        }
    }

    public function storeProperty()
    {
        if(Auth::user()->hasRole('agent')) {
            $this->user_id = Auth::user()->id;
        }

        $this->validate();

        $property = new Property();

        foreach ([
            'user_id', 'type_id', 'name', 'price', 'surface', 'lat', 'lon',
            'rooms', 'toilets', 'bedrooms', 'garage', 'furnished', 'floors',
            'lease_duration', 'video_intercom', 'keycard_entry', 'elevator',
            'city', 'street', 'country', 'description', 'year_built', 'garden',
        ] as $field) {
            $property->$field = $this->$field;
        }

        if ($property->garden === null) {
            $property->garden = 0;
        }

        foreach ($this->mediaArray as $key => $photo) {
            $property->addMedia($photo)->toMediaCollection('property-photos');
        }

        $property->status = 'Available';
        $property->save();

        if(Auth::user()->hasRole('agent')) {
            return redirect()->route('agent-properties')->with('success', 'Property created successfully.');
        } else {
            return redirect()->route('admin-properties')->with('success', 'Property created successfully.');
        }
    }
}
