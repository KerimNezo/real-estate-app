<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    // Function that returns 3 properties most similar to property passed as argument.
    public static function recommendSimilar(Property $property, int $count = 3)
    {
        // Query all properties which share same city, offer and similar property_type
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

        // Compute similarity scores for each queries property
        $recommendations = $properties->map(function ($otherProperty) use ($property) {
            $similarity = self::computeSimilarity($property, $otherProperty);
            logger("Property id: {$otherProperty->id}, similarity score: {$similarity}");
            return [
                'property' => $otherProperty,
                'similarity' => $similarity,
            ];
        });

        // Sort by similarity and return top n properties (default 3)
        return $recommendations->sortByDesc('similarity')->take($count)->pluck('property');
    }

    // Function to normalize values
    public static function normalize($value, $maxValue)
    {
        logger("Value: {$value}, Max Value: {$maxValue}");
        return ($maxValue > 0) ? $value / $maxValue : 0;
    }

    /** 
     * Function that computes similarity between two properties
     * We're computing the similarity based on each properites weighted attribute score
     * Based on the attribute, we use different calculation
     * This algoritham can, of course, be improved. 
     * The way we calculate distance for each score can be done more thoroughly, but I am satisfied with this for now.
     * Link to the Euclidean distance: https://en.wikipedia.org/wiki/Euclidean_distance
     * similarity score of 1 indicated identical properties, and similarity score close to 0 indicated dissimilar properties.
     */
    private static function computeSimilarity(Property $a, Property $b)
    {
        // Define weights for each attribute
        $weights = [
            'price' => 0.4,
            'surface' => 0.1,
            'rooms' => 0.1,
            'garage' => 0.07,
            'furnished' => 0.05,
        ];
    
        // Initialize Euclidean distance
        $distance = 0;
    
        // Iterate over each weighted attribute
        foreach ($weights as $attribute => $weight) {
            $valueA = $a->$attribute ?? 0;
            $valueB = $b->$attribute ?? 0;
    
            // Normalize values for numerical attributes
            if ($attribute === 'price') {
                $maxPrice = max($valueA, $valueB);
                $valueA = self::normalize($valueA, $maxPrice);
                $valueB = self::normalize($valueB, $maxPrice);
            } elseif ($attribute === 'surface' || $attribute === 'rooms' || $attribute === 'garage') {
                $maxValue = max($valueA, $valueB);
                $valueA = self::normalize($valueA, $maxValue);
                $valueB = self::normalize($valueB, $maxValue);
            } elseif ($attribute === 'furnished') {
                // Convert boolean to numerical value
                $valueA = $valueA ? 1 : 0;
                $valueB = $valueB ? 1 : 0;
            }
    
            // Calculate weighted squared difference
            $distance += $weight * pow($valueA - $valueB, 2);
        }
    
        // Return similarity (inverse of Euclidean distance)
        return 1 / (1 + sqrt($distance));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $property = Property::query()
                ->with(['media', 'user', 'type'])
                ->findOrFail($id);
        
            if ($property->status !== 'Available') {
                return redirect()->route('all-properties');
            }
        
            // Getting similar properties of $property
            $similarProperties = $this->recommendSimilar($property);
        
            return view('properties.show', [
                'property' => $property,
                'similarProperties' => $similarProperties,
            ]);
        
        } catch (ModelNotFoundException $e) {
            // Handle the case where the property is not found
            return redirect()->route('all-properties')->with('error', 'Property not found.');
        } catch (\Exception $e) {
            // Handle any other exceptions that might occur
            return redirect()->route('all-properties')->with('error', 'An error occurred while fetching the property.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        if (Auth::user()->hasRole('admin') || Auth::id() === $property->user_id) {
            // Checking if property can be edited by its status.
            if ($property->status === 'Available' || $property->status === 'Unavailable') {
                $propertyMedia = $property->getMedia('property-photos')->sortBy('order_column');

                return view('admin.property.edit')
                    ->with('property', $property)
                    ->with('propertyMedia', $propertyMedia);
            }
        } 
        
        if (Auth::user()->hasRole('agent')) {
            return redirect()->route('agent-properties')->with('error', 'Unable to edit property.');
        }

        return redirect()->route('admin-properties')->with('error', 'Unable to edit property.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $property = Property::find($id);

        // Checking if property exist. Although I think it can't come to this here, bcs I think we're checking for this in route.
        if ($property === null) {
            return redirect()->route('admin-properties')->with('error', 'This property does not exist');
        }

        try {
            if (Auth::user()->hasRole('admin') || Auth::id() === $property->user_id) {
                // Updating property status
                $property->status = 'Removed';

                // Saving property update without sending event to observer.
                $property->saveQuietly();

                // Soft deleting the property
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
