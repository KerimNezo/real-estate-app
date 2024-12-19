<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ProfitChart extends Component
{
    public $timeframe = "3";
    public $data = [];

    public $rentSeries, $sellSeries, $totalSeries, $labels = '';

    public function mount() {

        // I want to have chart graph, that will display, 3 6 or 12 months as labels.
        // Depending on them, lets use 3 months as example, I want it to query
        // actions, for last three months from todays day, and fetch every action
        // named 'rented' and 'sold' during that period, and I want them grouped by
        // the month from now. then add values in month together for rented and for sold
        // then I want third column, total that will combine each month rented + sold.
        // so for e.x. I have july total 5, rented 4, sold 2.

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
