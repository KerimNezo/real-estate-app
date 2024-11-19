<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\User;

class StoreAgent extends Component
{
    #[Validate]
    public $name, $email, $phoneNumber, $password;

    public $novaSlika;

    public $agentPicture;

    // nova slika koju kupimo iz child componenta
    public $photoData;

    #[On('photoDataUpdated')]
    public function updatePhotoData($picture)
    {
        logger('slika nova ', [$picture]);
        $this->photoData = $picture;
    }

    // validation error rules
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $this->agent->id,
            'phoneNumber' => 'required|regex:/^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{3,4}$/',
            'password' => [
                'nullable',
                'min:8',
                'regex:/^(?=.*[0-9])[a-zA-Z0-9]+$/',
            ],
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
        ];
    }

    public function storeAgent()
    {
        logger('>---------------------------------------------<');

        logger('name '. $this->name);
        logger('email '. $this->email);
        logger('phoneNumber '. $this->phoneNumber);
        logger('password '. $this->password);

        logger('Before validation');

        $this->validate();

        logger('Validation passed');

        // ovdje ćemo kreirati agenta i storeat ga u db
        User::create([$this->name, $this->pa]);

        $slika = $this->pull('novaSlika');
        // ovo sad ovdje nam daje path slike gdje je ona temporary storana, što nam treba za njen upload
        // pullamo value Modelable propertya iz child componenta nazad u property parent komponente
        // more info: https://livewire.laravel.com/docs/nesting#binding-to-child-data-using-wiremodel

        if ($slika !== null)
        {
            // ovdje ćemo storeati default sliku ako nije unesena slika
            $this->agent->addMedia(asset('photos/icons/realestateagent.png'))->toMediaCollection('agent-pfps');
        } else {
            // ovdje ćemo storeati unesenu sliku
            $this->agent->addMedia($slika)->toMediaCollection('agent-pfps');
        }

        return redirect()->route('all-agents')->with('success', 'Agent updated successfully.');
    }
}
