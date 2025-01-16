<?php

namespace App\Livewire\Admin;

use App\Models\Actions;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProfitChart extends Component
{
    public function mount()
    {
        // Displays the ChartData for last months (Default first view)
        $this->updateChartData(3);
    }

    public function updateLineChart($numMonths)
    {

        $this->updateChartData($numMonths);
    }

    public function updateChartData($months)
    {
        // Get current date and subtract months
        $startDate = new \DateTime();
        $startDate->modify("-$months month")->modify('first day of this month');

        $endDate = new \DateTime();
        $endDate->modify('last day of this month');

        // Prepare all months in range
        $allMonths = collect();
        $current = clone $startDate;

        while ($current <= $endDate) {
            // Format as 'Y-m'
            $allMonths->push($current->format('Y-m'));
            // Move to the next month
            $current->modify('first day of next month');
        }

        $actions = Actions::query()
            ->join('properties', 'actions.property_id', '=', 'properties.id')
            ->whereBetween('actions.created_at', [$startDate, $endDate])
            ->whereIn('actions.name', ['rented', 'sold'])
            ->when(Auth::user()->hasRole('agent'), function ($query) {
                $query->where('properties.user_id', Auth::user()->id);
            })
            ->selectRaw('
                DATE_FORMAT(actions.created_at, "%Y-%m") as month,
                actions.name,
                SUM(properties.price) as total_price
            ')
            ->groupBy('month', 'actions.name')
            ->orderBy('month')
            ->get();

        // Reformat results into a structured collection
        $groupedActions = $actions->groupBy('month')->map(function ($monthData) {
            return [
                'rented' => $monthData->firstWhere('name', 'rented')['total_price'] ?? 0,
                'sold' => $monthData->firstWhere('name', 'sold')['total_price'] ?? 0,
            ];
        });

        $chartData = [
            'labels' => [],
            'rented' => [],
            'sold' => [],
            'total' => [],
        ];

        // Process each month
        foreach ($allMonths as $month) {
            $monthData = $groupedActions[$month] ?? ['rented' => 0, 'sold' => 0];
            $rentedPrice = $monthData['rented'];
            $soldPrice = $monthData['sold'];
            $totalPrice = $rentedPrice + $soldPrice;

            // Extract month part
            list($year, $monthNum) = explode("-", $month);

            // Format month number to get the abbreviated month name
            $monthLabel = date('M', strtotime("2024-$monthNum-01"));

            // Populate chart data
            $chartData['labels'][] = $monthLabel;
            $chartData['rented'][] = $rentedPrice;
            $chartData['sold'][] = $soldPrice;
            $chartData['total'][] = $totalPrice;
        }

        // logger($chartData);

        // Dispatch chart update event to components blade JS
        $this->dispatch('updateLineChart', [
            'labels' => $chartData['labels'],
            'totalSeries' => $chartData['total'],
            'sellSeries' => $chartData['sold'],
            'rentSeries' => $chartData['rented'],
        ]);
    }

    public function render()
    {
        return view('livewire.admin.profit-chart');
    }
}
