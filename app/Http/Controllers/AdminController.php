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
        $propertyData = $property->getAttributes();
        $userData = $user->getAttributes();

        $media = $property->getMedia('property-photos');

        $propertyData['Type'] = $this->changeTypeData($propertyData['type_id']);

        unset($propertyData['type_id'], $propertyData['created_at'], $propertyData['updated_at'], $propertyData['user_id'], $propertyData['id']);

        unset($userData['created_at'], $userData['updated_at'], $userData['email_verified_at'], $userData['password'], $userData['remember_token']);

        foreach ($media as $slike) {
            $urlovi[$slike->order_column] = $slike->getUrl();
        }

        return view('admin.property.show')
            ->with('property', $property)
            ->with('propertyData', $propertyData)
            ->with('userData', $userData)
            ->with('media', $media)
            ->with('urlovi', $urlovi);
    }

    public function changeTypeData(int $number) {
        switch ($number) {
            case 1:
                return 'Office';
            case 2:
                return 'House';
            case 3:
                return 'Appartement';
            default:
                return 'Unknown';
        }
    }
}
