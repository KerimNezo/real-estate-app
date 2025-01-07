<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Invokeable search controller that just checks for inputs from entered from user and sends them to index page, ResultList component.
     */
    public function __invoke(Request $request)
    {
        $filters = [
            'location' => null,
            'offer_type' => null,
            'property_type' => null,
            'min_price' => null,
            'max_price' => null,
            'sort' => 'created_at',
        ];

        if (! is_null($assetLocation = $request->query('asset-location'))) {
            $filters['location'] = $assetLocation;
        }

        if (! is_null($assetOffer = $request->query('asset-offer-id'))) {
            $filters['offer_type'] = $assetOffer;
        }

        if (! is_null($assetId = $request->query('type-of-asset-id')) && $assetId > 0) {
            $filters['property_type'] = $assetId;
        }

        if (! is_null($minPrice = $request->query('min-price'))) {
            $filters['min_price'] = $minPrice;
        }

        if (! is_null($maxPrice = $request->query('max-price'))) {
            $filters['max_price'] = $maxPrice;
        }

        return view('properties.index')
            ->with('filters', $filters);
    }
}
