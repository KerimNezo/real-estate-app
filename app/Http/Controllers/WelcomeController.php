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

        return view('welcome', ['properties' => $properties]);
    }
}
//->where('featured', '=', '1')
