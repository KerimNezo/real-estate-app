<?php

namespace App\Http\Controllers;

use App\Models\Property;

class WelcomeController extends Controller
{
    /**
     * Invokeable WelcomeController that queries 6 latest properties with 'Available' status and their first image
     * Return welcome blade
     */
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

        return view('welcome')
            ->with('properties', $properties);
    }
}
