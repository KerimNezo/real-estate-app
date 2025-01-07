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

        $properties = Property::query()
            ->select('id', 'type_id', 'name', 'price', 'city', 'bedrooms', 'garage', 'furnished', 'floors', 'lease_duration', 'keycard_entry', 'surface', 'toilets')
            ->latest()
            ->where('status', 'Available')
            ->with(['media' => function ($query) {
                $query->orderBy('order_column', 'asc')
                    ->limit(1);
            }]);

        if (! is_null($assetLocation = $request->query('asset-location'))) {
            $properties = $properties->where('city', '=', $assetLocation);
        }

        if (! is_null($assetOffer = $request->query('asset-offer-id'))) {
            $properties = match ($assetOffer) {
                '1' => $properties = $properties->where(function ($leaseQuery) {
                        $leaseQuery->where('lease_duration', '=', 0)
                            ->orWhere('lease_duration', null);
                    }),
            '2' => $properties->where('lease_duration', '>', 0)
            };
        }

        if (! is_null($assetId = $request->query('type-of-asset-id')) && $assetId > 0) {
            $properties = $properties->where('type_id', '=', $assetId);
        }

        if (! is_null($minPrice = $request->query('min-price'))) {
            $properties = $properties->where('price', '>', $minPrice);
        }

        if (! is_null($maxPrice = $request->query('max-price'))) {
            $properties = $properties->where('price', '<', $maxPrice);
        }

        $result = $properties->get();

        $propertyCount = $result->count();

        return view('properties.index')
            ->with('properties', $result)
            ->with('propertyCount', $propertyCount)
            ->with('cities', $cities);
    }
}
