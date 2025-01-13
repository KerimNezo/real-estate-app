<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

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

    // Validation error rules
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'phoneNumber' => 'required|regex:/^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{3,4}$/',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[0-9])[a-zA-Z0-9]+$/',
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

    // Function that handles the storing of Agent model to DB
    public function storeAgent()
    {
        $this->validate();

        $agent = new User();

        $agent->name = $this->name;
        $agent->email = $this->email;
        $agent->phone_number = $this->phoneNumber;
        $agent->password = bcrypt($this->password);

        // ovdje ćemo storeati unesenu sliku
        $agent->addMedia($this->newPhoto->getRealPath())->toMediaCollection('agent-pfps');
        $agent->assignRole('agent');

        $agent->save();

        return redirect()->route('all-agents')->with('success', 'Agent created successfully.');
    }
}
