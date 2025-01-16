<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\PropertyDataConversionService;

class AdminController extends Controller
{
    public function indexAgent()
    {
        return view('admin.agent.index');
    }

    public function showAgent(User $user)
    {
        $agentData = $user->getAttributes();

        unset($agentData['id'], $agentData['created_at'], $agentData['updated_at'], $agentData['email_verified_at'], $agentData['password'], $agentData['remember_token'], $agentData['deleted_at']);

        return view('admin.agent.show')
            ->with('agent', $user)
            ->with('agentData', $agentData);
    }

    public function createAgent()
    {
        return view('admin.agent.create');
    }

    public function editAgent(User $user)
    {
        return view('admin.agent.edit')
            ->with('agent', $user);
    }

    // Property Routes
    public function indexProperites(Request $request)
    {
        $cities = Property::query()
            ->select('city')
            ->distinct()
            ->pluck('city');

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
        return view('admin.property.create');
    }

    public function showProperty(User $user, Property $property)
    {
        $propertyData = $property->getAttributes();
        $userData = $user->getAttributes();

        $media = $property->getMedia('property-photos');

        // Initializing PropertyDataConversion service
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

        return view('admin.property.show')
            ->with('property', $property)
            ->with('propertyData', $propertyData)
            ->with('userData', $userData)
            ->with('media', $media)
            ->with('urlovi', $urlovi)
            ->with('lon', $lon)
            ->with('lat', $lat);
    }
}
