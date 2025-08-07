<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatchAllController extends Controller
{
    public function __invoke(Request $request)
    {
        $currentRoute = $request->url();
        $backRoute = url('');
        return view('catch-all', compact('currentRoute', 'backRoute'));
    }
}
