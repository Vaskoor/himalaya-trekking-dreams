<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HelicopterTour;
use Illuminate\Http\Request;

class HelicopterTourController extends Controller
{
    public function index()
    {
        $tours = HelicopterTour::where('is_active', true)->get();
        return response()->json($tours);
    }

    public function show($slug)
    {
        $tour = HelicopterTour::where('slug', $slug)->firstOrFail();
        return response()->json($tour);
    }
}