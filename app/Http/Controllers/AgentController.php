<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        unset($agentData['id'], $agentData['created_at'], $agentData['updated_at'], $agentData['email_verified_at'], $agentData['password'], $agentData['remember_token'], $agentData['deleted_at']);

        return view('agent.show')
            ->with('agent', $agent)
            ->with('agentData', $agentData);
    }

    public function indexProperties(Request $request)
    {
        // action that returns index blade that displays all properties
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

    public function editProperty(Property $property)
    {
        $propertyMedia = $property->getMedia('property-photos')->sortBy('order_column');

        return view('agent.property.edit')
            ->with('property', $property)
            ->with('propertyMedia', $propertyMedia);
    }

    public function showProperty(Property $property)
    {
        // action that return blade that displays single property data

        $propertyData = $property->getAttributes();

        $media = $property->getMedia('property-photos');

        $propertyData['Type'] = $this->changeTypeData($propertyData['type_id']);

        $lon = $propertyData['lon'];
        $lat = $propertyData['lat'];

        unset($propertyData['type_id'], $propertyData['created_at'], $propertyData['updated_at'], $propertyData['user_id'], $propertyData['id'], $propertyData['lon'], $propertyData['lat'], $propertyData['deleted_at']);

        if ($media->isNotEmpty()) {
            foreach ($media as $slike) {
                $urlovi[$slike->order_column] = $slike->getUrl();
            }
        } else {
            $urlovi = 0;
        }

        $propertyData['garden'] = $this->numberToBool($propertyData['garden']);
        $propertyData['furnished'] = $this->numberToBool($propertyData['furnished']);
        $propertyData['keycard_entry'] = $this->numberToBool($propertyData['keycard_entry']);
        $propertyData['elevator'] = $this->numberToBool($propertyData['elevator']);
        $propertyData['video_intercom'] = $this->numberToBool($propertyData['video_intercom']);
        $propertyData['garage'] = $this->numberOrNo($propertyData['garage']);

        $propertyData = $this->reorderArray($propertyData);

        return view('agent.property.show')
            ->with('property', $property)
            ->with('propertyData', $propertyData)
            ->with('media', $media)
            ->with('urlovi', $urlovi)
            ->with('lon', $lon)
            ->with('lat', $lat);
    }

    // sve ove funkcije iza možeš staviti u jedan controller (propertyDataController) i pozvati ga ovdje i u adminController da možeš
    // ove funckije koristiti bez da ih napišeš dva puta. Trenutno nek stoje dva put samo da ima

    public function changeTypeData(int $number)
    {
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

    public function reorderArray($array)
    {
        $reorderedArray = [];

        $desiredOrder = [
            'name', 'Type', 'price', 'city', 'street', 'country', 'surface',
            'year_built', 'status', 'lat', 'lon', 'rooms', 'bedrooms', 'toilets',
            'garage', 'furnished', 'floors', 'garden', 'lease_duration',
            'video_intercom', 'keycard_entry', 'elevator', 'description',
        ];

        foreach ($desiredOrder as $key) {
            if (isset($array[$key])) {
                $reorderedArray[$key] = $array[$key];
            }
        }

        return $reorderedArray;
    }

    public function numberToBool($value)
    {
        if ($value === 0 || $value === null) {
            return $value = 'No';
        } else {
            return $value = 'Yes';
        }
    }

    public function numberOrNo($value)
    {
        if ($value === null || $value === 0) {
            return $value = 'No';
        } else {
            return $value;
        }
    }
}
