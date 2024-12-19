<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Property;

class PropertiesChart extends Component
{
    public function mount() {
        $this->updateChartData('Available');
    }

    public function updatePieChart($status){
        $this->updateChartData($status);
    }

    public function updateChartData($status) {
        $labels = [];

        $series = [];

        $data = Property::query()
            ->withTrashed()
            ->select('type_id', DB::raw('count(*) as total'))
            ->where('status', $status)
            ->groupBy('type_id')
            ->get();

        foreach ($data as $property)
        {
            if($property->type_id === 1) {
                $series[] = $property->total;
                $labels[] = 'Offices';
            } elseif ($property->type_id === 2) {
                $series[] = $property->total;
                $labels[] = 'Houses';
            } elseif ($property->type_id === 3) {
                $series[] = $property->total;
                $labels[] = 'Apartments';
            }
        }

        $this->dispatch('updateDonutChart', ['labels' => $labels, 'series' => $series]);
    }

    public function render()
    {
        return view('livewire.admin.properties-chart');
    }
}
