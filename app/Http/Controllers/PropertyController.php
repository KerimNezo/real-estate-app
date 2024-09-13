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
        $properties = Property::query()
            ->select('id', 'type_id', 'name', 'price', 'city', 'bedrooms', 'garage', 'furnished', 'floors', 'lease_duration', 'keycard_entry', 'surface', 'toilets')
            ->latest()
            ->with(['media' => function ($query) {
                $query->orderBy('order_column', 'asc')
                    ->limit(1);
            }])
            ->get();

        $propertyCount = $properties->count();

        $cities = $properties->pluck('city')->unique()->values();

        return view('properties.index')
            ->with('properties', $properties)
            ->with('propertyCount', $propertyCount)
            ->with('cities', $cities);
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
    public function show(string $id)
    {
        /*
        Ovdje ću morati ubaciti item-based collaborative filtering sistem,
        To zamišljam kao neku funkciju koja će raditi taj filtering
        similarProperties($property)
        i vraća mi listu koja ima 5 property-a koji su slični
        primarno se gleda, sell/rent->lokacija->price->kvadratura.... ugl trebat će istražiti tačno kako jedan takav sistem radi
        */
        $property = Property::query()
            ->with(['media', 'user', 'type']) // Adjust relations as needed
            ->findOrFail($id);

        return view('properties.show', [
            'property' => $property,
        ]);
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
