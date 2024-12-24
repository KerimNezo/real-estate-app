<?php

namespace App\Http\Controllers;

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
}
