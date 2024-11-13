<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Validate;

class AgentForm extends Component
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

    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phoneNumber' => 'required|regex:/^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{3,4}$/',
            'password' => [
                'same:confirmPass',
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

            'phoneNumber.required' => 'Please enter agents phone number',
            'phoneNumber.regex' => 'Make sure agents phone number is of valid length',

            'password.min' => 'Your password is too short',
            'password.regex' => 'Your password can only contain letters and numbers and must have at least one number',
            'password.same' => 'Passwords do not match',
        ];
    }

}
