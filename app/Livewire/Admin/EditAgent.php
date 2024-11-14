<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Validate;

class EditAgent extends Component
{
    #[Validate]
    public $name, $email, $phoneNumber, $password, $confirmPass;

    public $agent;

    public function mount()
    {
        $this->name = $this->agent->name;
        $this->email = $this->agent->email;
        $this->phoneNumber = $this->agent->phone_number;
    }

    public $agentPicture;


    public $photoData, $formData;

    protected $listeners = [
        'photoDataUpdated' => 'updatePhotoData',
    ];

    public function updatePhotoData($picture)
    {
        $this->photoData = $picture;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $this->agent->id,
            'phoneNumber' => 'required|regex:/^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{3,4}$/',
            'confirmPass' => [
                'same:password',
                'nullable',
                'min:8',
                'regex:/^(?=.*[0-9])[a-zA-Z0-9]+$/',
            ],
        ];
    }

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

            'confirmPass.min' => 'Your password is too short',
            'confirmPass.regex' => 'Your password can only contain letters and numbers',
            'confirmPass.same' => 'Passwords do not match',
        ];
    }

    public function saveAgent()
    {
        logger('>---------------------------------------------<');

        // You can now access $this->agentData and $this->agentPicture here
        logger('Agent Picture:', [$this->photoData]);
        logger('name '. $this->name);
        logger('email '. $this->email);
        logger('phoneNumber '. $this->phoneNumber);
        logger('password '. $this->password);
        logger('confirmPass '. $this->confirmPass);

        logger('Before validation');

        $this->validate();

        logger('Validation passed');

        return redirect()->route('all-agents')->with('success', 'Agent updated successfully');
    }

}
