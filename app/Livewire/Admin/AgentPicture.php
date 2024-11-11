<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;

class AgentPicture extends Component
{

    use WithFileUploads;

    public $agentPicture;

    public $tempPhoto;

    public function mount()
    {
        $this->tempPhoto = $this->agentPicture;
    }

    public function resetPhoto()
    {
        $this->tempPhoto = $this->agentPicture;
    }

}
