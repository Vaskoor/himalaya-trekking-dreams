<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Peak;
use Illuminate\Http\Request;

class PeakController extends Controller
{
    public function index()
    {
        $peaks = Peak::where('is_active', true)->get();
        return response()->json($peaks);
    }

    public function show($slug)
    {
        $peak = Peak::where('slug', $slug)->firstOrFail();
        return response()->json($peak);
    }
}