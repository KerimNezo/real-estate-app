<?php

namespace App\Http\Controllers;

use App\Models\Property;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $properties = Property::query()
            ->select('id', 'type_id', 'name', 'price', 'city', 'bedrooms', 'garage', 'furnished', 'floors', 'lease_duration', 'keycard_entry', 'surface', 'toilets')
            ->with(['media' => function ($query) {
                $query->orderBy('order_column', 'asc')
                      ->limit(1);
            }])
            ->get();

        $propertyCount = $properties->count();

        return view('welcome')
            ->with('properties', $properties)
            ->with('property_count', $propertyCount);
    }
}
