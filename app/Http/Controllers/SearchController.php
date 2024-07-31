<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $properties = Property::query()->with(['user', 'type']);

        if (! is_null($asset_id = $request->query('type-of-asset-id'))) {
            $properties = $properties->where('type_id', '=', $asset_id);
        }
        if (! is_null($min_price = $request->query('min-price'))) {
            $properties = $properties->where('price', '>', $min_price);
        }
        if (! is_null($max_price = $request->query('max-price'))) {
            $properties = $properties->where('price', '<', $max_price);
        }

        $result = $properties->get();

        dd($result);

        return view('properties.index', ['properties' => $properties]);
    }
}
