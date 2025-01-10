<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// OVDJE IMA POSLA ZNAČI MILION, ali kasnije malo. index i show, sad, a ovi ostali su tek kasnije kad agente ubacimo

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = [
            'location' => null,
            'offer_type' => null,
            'property_type' => null,
            'min_price' => null,
            'max_price' => null,
            'sort' => 'created_at',
        ];

        return view('properties.index')
            ->with('filters', $filters);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agent.property.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ovo stavi u createProperty formu

        // return redirect()->route('properties.index');
    }


    // Functions used for item-to-item based collaboration algorithm.

    public static function recommendSimilar(Property $property, int $count = 3)
    {

        //treba i type_id
        $properties = Property::query()
            ->where('id', '!=', $property->id)
            ->where('status', 'available')
            ->where('lease_duration', $property->lease_duration)
            ->where('city', $property->city)
            ->when($property->type_id === 1, function ($query) {
                $query->where('type_id', 1);
            }, function ($query) {
                $query->where('type_id', '!=', 1);
            })
            ->get();

        // Compute similarity scores
        $recommendations = $properties->map(function ($otherProperty) use ($property) {
            $similarity = self::computeSimilarity($property, $otherProperty);
            logger("Property id: {$otherProperty->id}, similarity score: {$similarity}");
            return [
                'property' => $otherProperty,
                'similarity' => $similarity,
            ];
        });

        // Sort by similarity and return top N
        return $recommendations->sortByDesc('similarity')->take($count)->pluck('property');
    }

    private static function computeSimilarity(Property $a, Property $b)
    {
        // Define weights for each attribute
        $weights = [
            'price' => 0.4,
            'surface' => 0.1,
            'rooms' => 0.1,
            'garage' => 0.7,
            'furnished' => 0.05,
        ];

        $distance = 0;

        foreach ($weights as $attribute => $weight) {
            $valueA = $a->$attribute ?? 0;
            $valueB = $b->$attribute ?? 0;

            if ($attribute === 'price') {
                // Normalize price difference
                $maxPrice = max($valueA, $valueB);
                $priceDifference = ($maxPrice > 0) ? abs($valueA - $valueB) / $maxPrice : 0;
                $distance += $weight * pow($priceDifference, 2);
            } else {
                // Numerical comparison for other attributes
                $distance += $weight * pow($valueA - $valueB, 2);
            }
        }

        // Return similarity (inverse of distance)
        return 1 / (1 + sqrt($distance));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $property = Property::query()
            ->with(['media', 'user', 'type']) // Adjust relations as needed
            ->findOrFail($id);

        if ($property->status !== 'Available') {
            return redirect()->route('all-properties');
        }

        $similarProperties = $this->recommendSimilar($property);

        logger($similarProperties);

        return view('properties.show', [
            'property' => $property,
            'similarProperties' => $similarProperties,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        if ($property->status === 'Available' || $property->status === 'Unavailable') {
            $propertyMedia = $property->getMedia('property-photos')->sortBy('order_column');

            return view('admin.property.edit')
                ->with('property', $property)
                ->with('propertyMedia', $propertyMedia);
        }

        return redirect()->route('admin-properties')->with('error', 'Unable to edit property.');
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
    public function destroy($id)
    {
        logger($id);

        $property = Property::find($id);

        if ($property === null) {
            return redirect()->route('admin-properties')->with('error', 'This property does not exist in the database');
        }

        try {
            if (Auth::user()->hasRole('admin') || Auth::id() === $property->user_id) {
                // Delete the property
                $property->status = 'Removed';

                $property->saveQuietly();

                $property->delete();

                // Return a success response
                return redirect()->route('admin-properties')->with('success', 'Property deleted successfully.');
            }
        } catch (\Exception $e) {
            // Handle any errors that might occur
            return redirect()->route('admin-properties')->with('error', 'There was an issue deleting the property.');
        }
    }
}
