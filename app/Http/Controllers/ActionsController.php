<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actions;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class ActionsController extends Controller
{
    public function index()
    {
        return view('admin.action.index');
    }

    public function show(string $id)
    {
        $action = Actions::query()
            ->select('id', 'user_id', 'property_id', 'name', 'message', 'created_at')
            ->with(['user', 'property']) // Adjust relations as needed
            ->findOrFail($id);

        $actionData = $action->getAttributes();

        unset($actionData['user_id'], $actionData['property_id']);

        $actionData['created_at'] = Carbon::parse($action->created_at)->format('F j, Y \a\t g:i A');

        return view('admin.action.show', [
            'action' => $action,
            'actionData' => $actionData,
        ]);
    }
}
