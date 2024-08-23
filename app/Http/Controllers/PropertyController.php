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
        // kad koristimo ovaj with(), to nam querya i sve podatke koji su relevantni iz tih tabela za primarni query
        // ovdje odma queryamo i podatke o useru koji je objabio nekretninu i o tipu kojeg je nekretnina
        $properties = Property::query()
            ->latest()
            ->with(['user', 'type'])
            ->get();

        $propertyCount = $properties->count();

        $cities = $properties->pluck('city')->unique()->values();

        //logger($cities); we alog all cities plucked from $properties

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
        // ovdje ćemo nekako morati ubaciti item-based collaborative filtering
        return view('properties.show')
            ->with('property', Property::with(['user'])->findOrFail($id));
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
