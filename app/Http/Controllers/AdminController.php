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

        return view('admin.agent.index')
            ->with('agents', $agents);
    }

    public function showAgent(User $user)
    {
        return view('admin.agent.show')
            ->with('agent', $user);
    }

    public function createAgent()
    {
        //action that opens up a page with a form to create new agent

        return view('admin.agent.create');
    }

    // ovi ispod će svi otvarati isti view
    public function indexProperites(Request $request)
    {
        $cities = Property::query()
            ->select('city') // Select only the city column
            ->distinct()     // Ensure cities are unique
            ->pluck('city'); // Get the cities as a collection

        $assetLocation = $request->query('asset-location');
        $assetId = $request->query('type-of-asset-id');
        $minPrice = $request->query('min-price');
        $maxPrice = $request->query('max-price');

        return view('admin.property.index')
            ->with('cities', $cities)
            ->with('minPrice', $minPrice)
            ->with('maxPrice', $maxPrice)
            ->with('assetLocation', $assetLocation)
            ->with('assetTypeId', $assetId);
    }

    public function createProperty()
    {
        // action that opens up a page with a form to create new agent

        return view('admin.property.create');
    }

    public function showProperty(User $user, Property $property)
    {
        $propertyAttributes = $property->getAttributes();

        unset($propertyAttributes['created_at'], $propertyAttributes['updated_at']);

        return view('admin.property.show')
            ->with('property', $property)
            ->with('propertyAttributes', $propertyAttributes)
            ->with('user', $user);
    }
}
