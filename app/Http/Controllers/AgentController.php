<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PropertyDataConversionService;

class AgentController extends Controller
{
    public function dashboard()
    {
        return view('agent.dashboard');
    }

    public function show()
    {
        $agent = Auth::user();
        $agentData = $agent->getAttributes();

        // Unsetting properties we don't want to be returned to user.
        unset($agentData['id'], $agentData['created_at'], $agentData['updated_at'], $agentData['email_verified_at'], $agentData['password'], $agentData['remember_token'], $agentData['deleted_at']);

        return view('agent.show')
            ->with('agent', $agent)
            ->with('agentData', $agentData);
    }

    // Function that returns index page of properties.
    public function indexProperties(Request $request)
    {
        $cities = Property::query()
            ->select('city')
            ->distinct()
            ->pluck('city');

        $assetLocation = $request->query('asset-location');
        $assetId = $request->query('type-of-asset-id');
        $minPrice = $request->query('min-price');
        $maxPrice = $request->query('max-price');

        return view('agent.property.index')
            ->with('cities', $cities)
            ->with('minPrice', $minPrice)
            ->with('maxPrice', $maxPrice)
            ->with('assetLocation', $assetLocation)
            ->with('assetTypeId', $assetId);
    }

    // Function that returns single property page
    public function showProperty(Property $property)
    {
        // Get list of user and property attributes
        $propertyData = $property->getAttributes();
        $userData = $property->user->getAttributes();

        $media = $property->getMedia('property-photos');

        // Initializing the propertyDataConversion service
        $propertyDataService = app(PropertyDataConversionService::class);

        $propertyData['Type'] = $propertyDataService->changeTypeData($propertyData['type_id']);

        $lon = $propertyData['lon'];
        $lat = $propertyData['lat'];

        unset($propertyData['type_id'], $propertyData['created_at'], $propertyData['updated_at'], $propertyData['user_id'], $propertyData['id'], $propertyData['lon'], $propertyData['lat'], $propertyData['deleted_at']);

        unset($userData['created_at'], $userData['updated_at'], $userData['email_verified_at'], $userData['password'], $userData['remember_token'], $userData['deleted_at']);

        if ($media->isNotEmpty()) {
            foreach ($media as $slike) {
                $urlovi[$slike->order_column] = $slike->getUrl();
            }
        } else {
            $urlovi = 0;
        }

        $propertyData['garden'] = $propertyDataService->numberToBool($propertyData['garden']);
        $propertyData['furnished'] = $propertyDataService->numberToBool($propertyData['furnished']);
        $propertyData['keycard_entry'] = $propertyDataService->numberToBool($propertyData['keycard_entry']);
        $propertyData['elevator'] = $propertyDataService->numberToBool($propertyData['elevator']);
        $propertyData['video_intercom'] = $propertyDataService->numberToBool($propertyData['video_intercom']);
        $propertyData['garage'] = $propertyDataService->numberOrNo($propertyData['garage']);

        $propertyData = $propertyDataService->reorderArray($propertyData);

        return view('agent.property.show')
            ->with('property', $property)
            ->with('propertyData', $propertyData)
            ->with('userData', $userData)
            ->with('media', $media)
            ->with('urlovi', $urlovi)
            ->with('lon', $lon)
            ->with('lat', $lat);
    }
}
