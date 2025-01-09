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
        $properties = Property::where('id', '!=', $property->id)
            ->where('status', 'available') // Ensure only available properties
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
            'city' => 0.3,
            'lease_duration' => 0.3,
            'type_id' => 0.3,
            'price' => 0.01,
            'surface' => 0.1,
            'rooms' => 0.1,
            'garage' => 0.7,
            'furnished' => 0.05,
        ];

        $distance = 0;

        foreach ($weights as $attribute => $weight) {
            $valueA = $a->$attribute ?? 0;
            $valueB = $b->$attribute ?? 0;

            if ($attribute === 'city') {
                // Categorical comparison for city
                $distance += $weight * (($valueA === $valueB) ? 0.5 : 0);
            } elseif ($attribute === 'lease_duration' || $attribute === 'type_id') {
                // Categorical comparison for lease_duration and type_id
                if ($attribute === 'type_id' && $valueA === 1) {
                    $distance += $weight * (($valueA === $valueB) ? 0 : 1);
                } else {
                    $distance += $weight * (($valueA === $valueB) ? 0 : 1);
                }
            } elseif ($attribute === 'price') {
                // Normalize price difference
                $maxPrice = max($valueA, $valueB);
                $priceDifference = ($maxPrice > 0) ? abs($valueA - $valueB) / $maxPrice : 0;
                $distance += $weight * pow($priceDifference, 2);
            } else {
                // Numerical comparison for other attributes
                $distance += $weight * pow($valueA - $valueB, 2);
            }
        }

        // Sredi dodatno ako je ofis u pitanju. Da bolje preporučuju.

        // Return similarity (inverse of distance)
        return 1 / (1 + sqrt($distance));
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
