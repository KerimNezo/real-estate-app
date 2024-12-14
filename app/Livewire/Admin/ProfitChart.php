<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ProfitChart extends Component
{
    public $timeframe = "3";
    public $data = [];

    public $rentSeries, $sellSeries, $totalSeries, $labels = '';

    public function mount() {
        // samo promijeni podatke

        // podaci se ovako trebaju slati u eventu
        $this->dispatch('updateLineChart', ['labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'],
             'totalSeries' => [5, 10, 25, 8, 14, 10, 16, 5, 11, 9, 10, 11],
             'sellSeries' => [2, 6, 17, 3, 7, 4, 9, 3, 5, 4, 3, 5],
             'rentSeries' => [3, 4, 8, 5, 7, 6, 7, 1, 6, 5, 7, 6]
            ]);
    }

    public function updateLineChart(){
        // ovdje trebam da skontam logiku po kojoj ću dobijati datu i to samo onda dispatchat.

        $this->dispatch('updateLineChart', ['labels' => ['Jan', 'Feb', 'Mar', 'Apr'], 'totalSeries' => [3,5,7,9], 'sellSeries' => [2,3,4,5], 'rentSeries' => [1,2,3,4]]);
    }

    public function render()
    {
        return view('livewire.admin.profit-chart');
    }
}
