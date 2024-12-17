<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actions;
use Illuminate\Support\Facades\Auth;

class ActionsController extends Controller
{
    public function index()
    {
        return view('admin.action.index');
    }

    public function show(string $id)
    {
        return view('admin.action.index', [
            'actionId' => $id,
        ]);
    }
}
