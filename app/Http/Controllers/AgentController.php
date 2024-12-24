<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;

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
}
