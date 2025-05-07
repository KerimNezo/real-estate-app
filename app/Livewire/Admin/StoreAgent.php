<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Services\ImageConversionService;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class StoreAgent extends Component
{
    use WithFileUploads;

    #[Validate]
    public $name;

    #[Validate]
    public $email;

    #[Validate]
    public $phoneNumber;

    #[Validate]
    public $password;

    #[Validate]
    public $newPhoto;

    public $newPhotoBase64 = null;

    // Validation error rules
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->whereNull('deleted_at'),
            ],
            'phoneNumber' => 'required|regex:/^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{3,4}$/',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9]+$/',
            ],
            'newPhoto' => 'required|mimetypes:image/jpg,image/jpeg,image/png,image/webp|max:1024',
        ];
    }

    // validation error messages
    public function messages()
    {
        return [
            'name.required' => 'Please enter agents name',
            'name.min' => 'Agents name is too short',

            'email.required' => 'Please enter agents email',
            'email.email' => 'Please insert valid email',
            'email.unique' => 'This email is already taken',

            'phoneNumber.required' => 'Please enter agents phone number',
            'phoneNumber.regex' => 'Make sure agents phone number is of valid length',

            'password.min' => 'Your password is too short',
            'password.regex' => 'Your password can only contain letters and numbers',

            'newPhoto.required' => 'Please upload agents profile picture',
            'newPhoto.mimetypes' => 'Please upload a photo',
            'newPhoto.max' => 'Please upload smaller photo',
        ];
    }

    public function updatedNewPhoto()
    {
        if ($this->newPhoto) {
            $this->newPhotoBase64 = base64_encode(file_get_contents($this->newPhoto->getRealPath()));
        }
    }

    // Function that handles the storing of Agent model to DB
    public function storeAgent()
    {
        $this->validate();

        $agent = new User();

        $agent->name = $this->name;
        $agent->email = $this->email;
        $agent->phone_number = $this->phoneNumber;
        $agent->password = bcrypt($this->password);

        // Converting uploaded photo to webp and storing it to db media collection 'agent-pfps'
        $imageService = app(ImageConversionService::class);
        $imageService->convertAndUpload($this->newPhoto->getRealPath(),$agent,'agent-pfps');
        
        // Assigning role to user
        $agent->assignRole('agent');

        $agent->save();

        return redirect()->route('all-agents')->with('success', 'Agent created successfully.');
    }
}
