<?php

namespace App\Http\Controllers;

use App\Models\Property;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $properties = Property::query()
            ->select('id', 'type_id', 'name', 'price', 'city', 'bedrooms', 'garage', 'furnished', 'floors', 'lease_duration', 'keycard_entry', 'surface', 'toilets')
            ->where('status', '=', 'Available')
            ->latest()
            ->with(['media' => function ($query) {
                $query->orderBy('order_column', 'asc')
                    ->limit(1);
            }])
            ->take(6)
            ->get();

        $propertyCount = $properties->count();

        return view('welcome')
            ->with('properties', $properties)
            ->with('property_count', $propertyCount);
    }
}
