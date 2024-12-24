<?php

namespace App\Livewire\Admin;

use App\Models\Actions;
use Carbon\Carbon;
use Livewire\Component;

class ProfitChart extends Component
{
    public function mount()
    {

        $this->updateChartData(3);
    }

    public function updateLineChart($numMonths)
    {

        $this->updateChartData($numMonths);
    }

    public function updateChartData($months)
    {

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
            'total' => [],
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

        $this->dispatch('updateLineChart', ['labels' => $chartData['labels'], 'totalSeries' => $chartData['total'], 'sellSeries' => $chartData['sold'], 'rentSeries' => $chartData['rented']]);
    }

    public function render()
    {
        return view('livewire.admin.profit-chart');
    }
}
