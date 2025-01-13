<?php

namespace App\Livewire\Admin;

use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PropertiesChart extends Component
{
    public $series, $labels;

    public function mount()
    {
        $this->updateChartData('Available');
    }

    public function updateChartData($status)
    {
        $this->labels = [];

        $this->series = [];

        // For admin we will fetch data of all agents, for agents only their data
        if(Auth::user()->hasRole('admin')){
            $data = Property::query()
                ->withTrashed()
                ->select('type_id', DB::raw('count(*) as total'))
                ->where('status', $status)
                ->groupBy('type_id')
                ->get();
        } else {
            $data = Property::query()
                ->withTrashed()
                ->select('type_id', DB::raw('count(*) as total'))
                ->where('status', $status)
                ->where('user_id', Auth::user()->id)
                ->groupBy('type_id')
                ->get();
        }

        // Sorting fetched data by the property type
        foreach ($data as $property) {
            if ($property->type_id === 1) {
                $this->series[] = $property->total;
                $this->labels[] = 'Offices';
            } elseif ($property->type_id === 2) {
                $this->series[] = $property->total;
                $this->labels[] = 'Houses';
            } elseif ($property->type_id === 3) {
                $this->series[] = $property->total;
                $this->labels[] = 'Apartments';
            }
        }

        // Dispatching event to js script inside components blade file.
        $this->dispatch('updateDonutChart', ['labels' => $this->labels, 'series' => $this->series]);
    }

    public function render()
    {
        return view('livewire.admin.properties-chart');
    }
}
