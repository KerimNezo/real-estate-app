<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $properties = Property::query()
            ->with(['user', 'type'])
            ->get();

        dd($properties);

        return view('welcome', ['properties' => $properties]);
    }
}
//->where('featured', '=', '1')
