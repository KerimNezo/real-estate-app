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
        $cities = Property::query()
            ->select('city') // Select only the city column
            ->distinct()     // Ensure cities are unique
            ->pluck('city'); // Get the cities as a collection

        $properties = Property::query()->latest()->with(['user', 'type']);

        if (! is_null($assetLocation = $request->query('asset-location'))) {
            logger('Assets location is {assetLocation}', ['assetLocation' => $assetLocation]);
            $properties = $properties->where('city', '=', $assetLocation);
        }

        if (! is_null($assetOffer = $request->query('asset-offer-id'))) {
            logger('Assets offer is {asset-offer}', ['asset-offer' => $assetOffer]);
            $properties = match ($assetOffer) {
                '0' => $properties->whereNull('lease_duration'), // sell
                '1' => $properties->whereNotNull('lease_duration'), // rent
                default => $properties,
            };
        }

        if (! is_null($assetId = $request->query('type-of-asset-id')) && $assetId > 0) {
            logger('Assets id is {asset-id}', ['asset-id' => $assetId]);
            $properties = $properties->where('type_id', '=', $assetId);
        }

        if (! is_null($minPrice = $request->query('min-price'))) {
            logger('Minimal price is {min-price}', ['min-price' => $minPrice]);
            $properties = $properties->where('price', '>', $minPrice);
        }

        if (! is_null($maxPrice = $request->query('max-price'))) {
            logger('Maximal price is {max-price}', ['max-price' => $maxPrice]);
            $properties = $properties->where('price', '<', $maxPrice);
        }

        $result = $properties->get();

        $propertyCount = $result->count();

        logger($cities);

        return view('properties.index')
            ->with('properties', $result)
            ->with('propertyCount', $propertyCount)
            ->with('cities', $cities);
    }
}
