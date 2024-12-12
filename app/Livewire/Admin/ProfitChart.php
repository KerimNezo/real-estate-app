<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ProfitChart extends Component
{
    public $timeframe = '3';
    public $data = [];

    public function mount() {
        // samo promijeni podatke
        // $this->dispatch('updateChart', ['labels' => ['Jan', 'Feb', 'Mar', 'Apr'], 'totalSeries' => [3,5,7,9], 'sellSeries' => [2,3,4,5], 'rentSeries' => [1,2,3,4]]);
    }

    public function updateGraph(){
        // ovdje trebam da dodajem

        $this->dispatch('updateChart', ['labels' => ['Jan', 'Feb', 'Mar', 'Apr'], 'totalSeries' => [3,5,7,9], 'sellSeries' => [2,3,4,5], 'rentSeries' => [1,2,3,4]]);
    }

    public function render()
    {
        return view('livewire.admin.profit-chart');
    }
}
