<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

// OVDJE IMA POSLA ZNAČI MILION, ali kasnije malo. index i show, sad, a ovi ostali su tek kasnije kad agente ubacimo

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::latest()
            ->with(['user','type'])
            ->get()
            ->groupBy('type_id');

        dd($properties);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        //
    }
}
