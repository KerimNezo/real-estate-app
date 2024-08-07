<?php

namespace App\Http\Controllers;

use App\Models\Property;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $properties = Property::query()
            ->with(['user', 'type'])
            ->get();

        $propertyCount = $properties->count();

        return view('welcome', ['properties' => $properties, 'property_count' => $propertyCount]);
    }
}
//->where('featured', '=', '1')
