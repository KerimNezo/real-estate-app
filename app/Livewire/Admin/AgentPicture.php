<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Computed;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class AgentPicture extends Component
{
    use WithFileUploads;

    public $agent;

    #[Validate]
    public $newPhoto = null;

    public $newPhotoBase64 = null;

    #[Modelable]
    public $pullPhoto;

    #[Computed]
    public function tempPhoto()
    {
        return $this->agent->getFirstMedia('agent-pfps');
    }

    // Function that triggers when new photo is updated
    public function updatedNewPhoto()
    {
        // Validation of new photo
        $this->validate();

        if ($this->newPhoto) {
            $this->newPhotoBase64 = base64_encode(file_get_contents($this->newPhoto->getRealPath()));
        }

        // We set pullPhoto to be realPath of uploaded photo.
        $this->pullPhoto = $this->newPhoto ? $this->newPhoto->getRealPath() : null;
    }

    // Validation rules
    public function rules()
    {
        return [
            'newPhoto' => 'nullable|mimetypes:image/jpg,image/jpeg,image/png,image/webp|max:1024',
        ];
    }

    // Validation error messages
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
        $this->newPhotoBase64 = null;
        $this->updatedNewPhoto();
    }
}
