<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class TourPackageController extends Controller
{
    public function index()
    {
        $packages = TourPackage::where('is_active', true)->get();
        return response()->json($packages);
    }

    public function show($slug)
    {
        $package = TourPackage::where('slug', $slug)->firstOrFail();
        return response()->json($package);
    }
}