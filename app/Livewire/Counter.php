<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function add()
    {

    }

    public function render()
    {
        logger('Rendero se view {counter}', ['count' => $this->count]);

        return view('livewire.counter');
    }
}
