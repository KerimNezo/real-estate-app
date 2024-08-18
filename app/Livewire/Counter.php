<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count = 1;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function render()
    {
        logger('Rendero se view {counter}', ['counter' => $this->count]);

        return view('livewire.counter');
    }
}
