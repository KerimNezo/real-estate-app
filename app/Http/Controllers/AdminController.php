<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Property;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function indexAgent()
    {
        $agents = User::query()
            ->select('name', 'email', 'phone_number')
            ->where('name', '!=', 'admin')
            ->get();
        //ovdje će se biti možda i profilna slika

        return view('admin.agents')
            ->with('agents', $agents);
    }

    public function showAgent($id)
    {
        $agent = User::query()
            ->select('name', 'email', 'phone_number')
            ->where('id', '==', $id)
            ->get();
        //ovdje će se biti možda i profilna slika

        return view('admin.agent')
            ->with('agent', $agent);
    }

    public function createAgent()
    {
        //action that opens up a page with a form to create new agent

        return view('admin.create-agent');
    }

    // ovi ispod će svi otvarati isti view
    public function showProperites(Request $request)
    {
        $cities = Property::query()
            ->select('city') // Select only the city column
            ->distinct()     // Ensure cities are unique
            ->pluck('city'); // Get the cities as a collection

        $properties = Property::query()
            ->select('user_id', 'id', 'type_id', 'name', 'price', 'city', 'lease_duration', 'year_built')
            ->latest()
            ->with(['media' => function ($query) {
                $query->orderBy('order_column', 'asc')
                    ->limit(1);
            }, 'user']);

        if (! is_null($assetLocation = $request->query('asset-location'))) {
            $properties = $properties->where('city', '=', $assetLocation);
        }

        if (! is_null($assetOffer = $request->query('asset-offer-id'))) {
            $properties = match ($assetOffer) {
                '1' => $properties->whereNull('lease_duration'), // sell
                '2' => $properties->whereNotNull('lease_duration'), // rent
                default => $properties,
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

        $result = $properties->paginate(10);

        return view('admin.index-properties')
            ->with('cities', $cities)
            ->with('properties', $result)
            ->with('propertyCount', $result->count());
    }
}
