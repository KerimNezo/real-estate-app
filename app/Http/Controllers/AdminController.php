<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function indexAgent()
    {
        return view('admin.agent.index');
    }

    public function showAgent(User $user)
    {
        $agentData = $user->getAttributes();

        unset($agentData['id'], $agentData['created_at'], $agentData['updated_at'], $agentData['email_verified_at'], $agentData['password'], $agentData['remember_token']);

        return view('admin.agent.show')
            ->with('agent', $user)
            ->with('agentData', $agentData);
    }

    public function createAgent()
    {
        //action that opens up a page with a form to create new agent

        return view('admin.agent.create');
    }

    public function storeAgent()
    {
        // stores the new User object with the data passed from the form

        // return view of agent-index
    }

    public function editAgent()
    {
        // return view with edit form
    }

    public function updateAgent()
    {
        // stores the object with updated data and returns to agent-index
    }

    public function deleteAgent(User $user)
    {
        try {
            // Delete the property
            $$user->delete();

            // Return a success response
            return redirect()->route('all-agents')->with('success', 'Property deleted successfully.');
        } catch (\Exception $e) {
            // Handle any errors that might occur
            return redirect()->route('all-agents')->with('error', 'There was an issue deleting the property.');
        }
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

        $propertyData['Type'] = $this->changeTypeData($propertyData['type_id']);

        $lon = $propertyData['lon'];
        $lat = $propertyData['lat'];

        unset($propertyData['type_id'], $propertyData['created_at'], $propertyData['updated_at'], $propertyData['user_id'], $propertyData['id'], $propertyData['lon'], $propertyData['lat']);

        unset($userData['created_at'], $userData['updated_at'], $userData['email_verified_at'], $userData['password'], $userData['remember_token']);

        if($media->isNotEmpty()){
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

        return view('admin.property.show')
            ->with('property', $property)
            ->with('propertyData', $propertyData)
            ->with('userData', $userData)
            ->with('media', $media)
            ->with('urlovi', $urlovi)
            ->with('lon', $lon)
            ->with('lat', $lat);
    }

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
