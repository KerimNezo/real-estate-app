<?php

namespace App\Livewire;

use Livewire\Component;

class PhotoGallery extends Component
{
    public $mediaItems;

    public $photoCount;

    public $id = 0;

    public function makeMainPhoto(int $id)
    {
        $this->id = $id;
    }

    public function nextPhoto()
    {
        if ($this->id == $this->photoCount - 1) {

        } else {
            $this->id++;
        }
    }

    public function previousPhoto()
    {
        if ($this->id == 0) {

        } else {
            $this->id--;
        }
    }

    public function render()
    {
        return view('livewire.photo-gallery');
    }
}
