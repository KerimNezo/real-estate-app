<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        dd('Ovo radi, samo sad uradit controller');

        dd($request);

        $properties = 1;

        return view('all-properties', ['properties' => $properties]);
    }
}
