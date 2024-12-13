<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class PropertiesChart extends Component
{

    public function mount() {
        // samo promijeni podatke

        $this->dispatch('updatePieChart', ['labels' => ['Houses', 'Apartments', 'Offices'], 'series' => [20, 14, 10]]);
    }

    public function updateGraph(){
        // ovdje trebam da skontam logiku po kojoj ću dobijati datu i to samo onda dispatchat.

        $this->dispatch('updatePieChart', ['labels' => ['Houses', 'Apartments', 'Offices'], 'series' => [20, 40, 40]]);
    }

    public function render()
    {
        return view('livewire.admin.properties-chart');
    }
}
