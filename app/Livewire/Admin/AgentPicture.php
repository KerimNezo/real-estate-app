<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

class AgentPicture extends Component
{

    use WithFileUploads;

    public $agentPicture;

    #[Validate]
    public $newPhoto;

    public $tempPhoto;

    public $tempNewPhoto;

    public function mount()
    {
        $this->tempPhoto = $this->agentPicture;
    }

    public function isImage($file)
    {
        return $file && in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/webp', 'image/jpeg']);
    }

    public function rules()
    {
        return [
            'newPhoto' => 'required|mimetypes:image/jpg,image/jpeg,image/png,image/webp|max:1024',
        ];
    }

    public function messages()
    {
        return [
            'newPhoto.required' => 'Please upload an image file.',
            'newPhoto.mimetypes' => 'Only JPG, JPEG, PNG, and WEBP files are allowed.',
            'newPhoto.max' => 'The image size must be less than 1MB.',
        ];
    }

    public function resetPhoto()
    {
        $this->newPhoto = null;
    }
}
