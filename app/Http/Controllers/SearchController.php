<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $properties = Property::query()->with(['user', 'type']);

        if (! is_null($asset_id = $request->query('type-of-asset-id')) && $asset_id > 0) {
            logger('Assets id is {asset-id}', ['asset-id' => $asset_id]);
            $properties = $properties->where('type_id', '=', $asset_id);
        }
        if (! is_null($min_price = $request->query('min-price'))) {
            logger('Minimal price is {min-price}', ['min-price' => $min_price]);
            $properties = $properties->where('price', '>', $min_price);
        }
        if (! is_null($max_price = $request->query('max-price'))) {
            logger('Maximal price is {max-price}', ['max-price' => $max_price]);
            $properties = $properties->where('price', '<', $max_price);
        }

        $result = $properties->get();

        dd($result);

        return view('properties.index', ['properties' => $properties]);
    }
}
