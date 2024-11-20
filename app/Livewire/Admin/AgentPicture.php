<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class AgentPicture extends Component
{
    use WithFileUploads;

    public $agent;

    #[Validate]
    public $newPhoto = null;

    #[Modelable]
    public $pullPhoto;

    #[Computed]
    public function tempPhoto()
    {
        return $this->agent->getFirstMedia('agent-pfps');
    }

    public function updatedNewPhoto()
    {
        $this->validate();

        $this->pullPhoto = $this->newPhoto ? $this->newPhoto->getRealPath() : null;
    }

    public function rules()
    {
        return [
            'newPhoto' => 'nullable|mimetypes:image/jpg,image/jpeg,image/png,image/webp|max:1024',
        ];
    }

    public function messages()
    {
        return [
            'newPhoto.mimetypes' => 'Only JPG, JPEG, PNG, and WEBP files are allowed.',
            'newPhoto.max' => 'The image size must be less than 1MB.',
        ];
    }

    public function resetPhoto()
    {
        $this->newPhoto = null;
        $this->updatedNewPhoto();
    }
}
