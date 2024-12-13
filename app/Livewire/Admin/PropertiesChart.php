<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class PropertiesChart extends Component
{
    public $status = "Available";

    public function mount() {
        // samo promijeni podatke

        // pobrini se da ovako šalješ datu da bi radilo sve kako treba
        $this->dispatch('updateDonutChart', ['labels' => ['Houses', 'Apartments', 'Offices'], 'series' => [20, 14, 10]]);
    }

    public function updatePieChart(){
        // ovdje trebam da skontam logiku po kojoj ću dobijati datu i to samo onda dispatchat.

        $this->dispatch('updateDonutChart', ['labels' => ['Houses', 'Apartments', 'Offices'], 'series' => [20, 40, 40]]);
    }

    public function render()
    {
        return view('livewire.admin.properties-chart');
    }
}
