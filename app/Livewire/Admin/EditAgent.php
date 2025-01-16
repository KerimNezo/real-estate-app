<?php

namespace App\Livewire\Admin;

use App\Services\ImageConversionService;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditAgent extends Component
{
    #[Validate]
    public $name;

    #[Validate]
    public $email;

    #[Validate]
    public $phoneNumber;

    #[Validate]
    public $password;

    #[Validate]
    public $password_confirmation;

    public $novaSlika;

    public $agent;

    public $agentPicture;

    public $photoData;

    public function mount()
    {
        $this->name = $this->agent->name;
        $this->email = $this->agent->email;
        $this->phoneNumber = $this->agent->phone_number;
    }

    #[On('photoDataUpdated')]
    public function updatePhotoData($picture)
    {
        logger('slika nova ', [$picture]);
        $this->photoData = $picture;
    }

    // Validation rules
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,'.$this->agent->id,
            'phoneNumber' => 'required|regex:/^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{3,4}$/',
            'password' => [
                'confirmed',
                'nullable',
                'min:8',
                'regex:/^(?=.*[0-9])[a-zA-Z0-9]+$/',
            ],
        ];
    }

    // Validation error messages
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
            'password.confirmed' => 'Passwords do not match',
        ];
    }

    // Function that handles agent model update
    public function saveAgent()
    {
        $this->validate();

        $slika = $this->pull('novaSlika');
        // ovo sad ovdje nam daje path slike gdje je ona temporary storana, što nam treba za njen upload
        // pullamo value Modelable propertya iz child componenta nazad u property parent komponente
        // more info: https://livewire.laravel.com/docs/nesting#binding-to-child-data-using-wiremodel

        if ($slika !== null) {
            $deletePhoto = $this->agent->getFirstMedia('agent-pfps');
            if ($deletePhoto) {
                $deletePhoto->delete();
            }

            // ImageConversionService to change uploaded photo to webp.
            $imageService = app(ImageConversionService::class);
            $imageService->convertAndUpload($slika,$this->agent,'agent-pfps');
        }

        // Update agents data 
        $this->agent->name = $this->name;
        $this->agent->email = $this->email;
        $this->agent->phone_number = $this->phoneNumber;

        // Update password if provided
        if (! empty($this->password)) {
            $this->agent->password = bcrypt($this->password);
        }

        // Save the agent's data
        $this->agent->save();

        return redirect()->route('all-agents')->with('success', 'Agent updated successfully.');
    }
}
