<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditAgent extends Component
{
    #[Validate]
    public $name, $email, $phoneNumber, $password, $password_confirmation;

    public $novaSlika;

    public $agent;

    public function mount()
    {
        $this->name = $this->agent->name;
        $this->email = $this->agent->email;
        $this->phoneNumber = $this->agent->phone_number;
    }

    public $agentPicture;

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
            'password.confirmed' => 'Passwords do not match',
        ];
    }

    public function saveAgent()
    {
        logger('>---------------------------------------------<');

        logger('name '.$this->name);
        logger('email '.$this->email);
        logger('phoneNumber '.$this->phoneNumber);
        logger('password '.$this->password);
        logger('password_confirmation '.$this->password_confirmation);

        logger('Before validation');

        $this->validate();

        logger('Validation passed');

        $slika = $this->pull('novaSlika');
        // ovo sad ovdje nam daje path slike gdje je ona temporary storana, što nam treba za njen upload
        // pullamo value Modelable propertya iz child componenta nazad u property parent komponente
        // more info: https://livewire.laravel.com/docs/nesting#binding-to-child-data-using-wiremodel

        if ($slika !== null) {
            $deletePhoto = $this->agent->getFirstMedia('agent-pfps');
            logger($deletePhoto);
            if ($deletePhoto) {
                $deletePhoto->delete();
            }
            // ovo brise sve slike iz kolekcije profilne slike agenta

            $this->agent->addMedia($slika)->toMediaCollection('agent-pfps');
            // dodajemo novu sliku u media-library, ime će biti
        }

        // trebaš još dodati logiku za storeanje ostalih ovih podataka
        // 1. provjeriti koji su promijenjeni i pass je li korektan
        // 2. one koji su promijenjeni, storeaj, koji nisu skipaj ih.
        // 3. to je to
        // to sutra uradi.

        $this->agent->name = $this->name;
        $this->agent->email = $this->email;
        $this->agent->phone_number = $this->phoneNumber;

        // Update password if provided
        if (! empty($this->password)) {
            $this->agent->password = bcrypt($this->password);
            logger('Password updated.');
        }

        // Save the agent's data
        $this->agent->save();

        return redirect()->route('all-agents')->with('success', 'Agent updated successfully.');
    }
}
