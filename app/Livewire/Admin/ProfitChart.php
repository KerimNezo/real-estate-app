<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Actions;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProfitChart extends Component
{
    public function mount() {
        // samo promijeni podatke

        // $this->updateChartData(3)

        // podaci se ovako trebaju slati u eventu
        $this->dispatch('updateLineChart', ['labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'],
             'totalSeries' => [5, 10, 25, 8, 14, 10, 16, 5, 11, 9, 10, 11],
             'sellSeries' => [2, 6, 17, 3, 7, 4, 9, 3, 5, 4, 3, 5],
             'rentSeries' => [3, 4, 8, 5, 7, 6, 7, 1, 6, 5, 7, 6]
            ]);
    }

    public function updateLineChart($numMonths) {

        // $this->updateChartData($numMonths)
        // ovdje trebam da skontam logiku po kojoj ću dobijati datu i to samo onda dispatchat.

        $this->dispatch('updateLineChart', ['labels' => ['Jan', 'Feb', 'Mar', 'Apr'], 'totalSeries' => [3,5,7,9], 'sellSeries' => [2,3,4,5], 'rentSeries' => [1,2,3,4]]);
    }

    public function updateChartData($months = 3) {

        // Calculate the starting date (last X months from today)
        $startDate = Carbon::now()->subMonths($months)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        // Query the actions table with a join on properties to get total price
        $actions = Actions::query()
            ->join('properties', 'actions.property_id', '=', 'properties.id')
            ->whereBetween('actions.created_at', [$startDate, $endDate])
            ->whereIn('actions.name', ['rented', 'sold'])
            ->selectRaw('
                DATE_FORMAT(actions.created_at, "%Y-%m") as month,
                actions.name,
                SUM(properties.price) as total_price
            ')
            ->groupBy('month', 'actions.name')
            ->orderBy('month')
            ->get();

        // Process the data
        $chartData = [
            'labels' => [],
            'rented' => [],
            'sold' => [],
            'total' => []
        ];

        // Iterate over each month within the range
        foreach (range(0, $months - 1) as $i) {
            $currentMonth = Carbon::now()->subMonths($months - $i - 1)->format('Y-m');

            $rentedPrice = $actions->where('month', $currentMonth)->where('name', 'rented')->sum('total_price');
            $soldPrice = $actions->where('month', $currentMonth)->where('name', 'sold')->sum('total_price');
            $totalPrice = $rentedPrice + $soldPrice;

            // Add data for the current month
            $chartData['labels'][] = Carbon::createFromFormat('Y-m', $currentMonth)->format('M'); // Use 'M' for short month name
            $chartData['rented'][] = $rentedPrice;
            $chartData['sold'][] = $soldPrice;
            $chartData['total'][] = $totalPrice;
        }

        logger($chartData);

        // sredi podatke i skontaj kako da ih pošalješ da valja i radit ce.

        // $this->dispatch('updateLineChart', ['labels' => ['Jan', 'Feb', 'Mar', 'Apr'], 'totalSeries' => [3,5,7,9], 'sellSeries' => [2,3,4,5], 'rentSeries' => [1,2,3,4]]);
    }

    public function render()
    {
        return view('livewire.admin.profit-chart');
    }
}
