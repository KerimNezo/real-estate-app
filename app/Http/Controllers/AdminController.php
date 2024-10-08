<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAgents()
    {
        $agents = User::query()
            ->select('name', 'email', 'phone_number')
            ->where('name', '!=', 'admin')
            ->get();
        //ovdje će se biti možda i profilna slika

        return view('admin.agents')
            ->with('agents', $agents);
    }

    public function showAgent($id)
    {
        $agent = User::query()
            ->select('name', 'email', 'phone_number')
            ->where('id', '==', $id)
            ->get();
        //ovdje će se biti možda i profilna slika

        return view('admin.agent')
            ->with('agent', $agent);
    }

    public function showHouses()
    {
        //query houses

        return 'sve kuce';
    }

    public function showOffices()
    {
        //query offcies

        return 'svi ofisi';
    }

    public function showAppartements()
    {
        //query appartements

        return 'svi stanovi';
    }
}
