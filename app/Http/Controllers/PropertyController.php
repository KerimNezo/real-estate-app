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
            ->where('status', '=', 'Available')
            ->with(['media' => function ($query) {
                $query->orderBy('order_column', 'asc')
                    ->limit(1);
            }])
            ->get();

        $cities = $properties->pluck('city')->unique()->values();

        return view('properties.index')
            ->with('properties', $properties)
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
        $propertyMedia = $property->getMedia('property-photos')->sortBy('order_column');

        return view('admin.property.edit')
            ->with('property', $property)
            ->with('propertyMedia', $propertyMedia);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        // Dolazi nam ovdje, sad ga samo treba hendlat

        logger($request);

        // $property = Property::findOrFail($property);

        // // Update text data
        // $property->update([
        //     'title' => $request->data['title'],
        //     'description' => $request->data['description'],
        // ]);

        // // Handle photo additions
        // foreach ($request->data['addedPhotos'] as $photo) {
        //     $property->addMedia($photo->getPath())->toMediaCollection('property-photos');
        // }

        // // Handle photo deletions
        // Media::destroy($request->data['removedPhotoIds']);

        // return redirect()->back()->with('status', 'Property updated successfully!');


        return redirect()->route('admin-properties')->with('success', 'Property updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        try {
            // Delete the property
            $property->delete();

            // Return a success response
            return redirect()->back()->with('success', 'Property deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors that might occur
            return redirect()->back()->with('error', 'There was an issue deleting the property.');
        }
    }
}
