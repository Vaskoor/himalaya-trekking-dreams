<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\Trek;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
        return response()->json($regions);
    }

    public function show($slug)
    {
        $region = Region::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $region->treks = Trek::where('region_id', $region->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        if ($region->popular_treks && is_array($region->popular_treks)) {
            $region->popular_treks_objects = Trek::whereIn('slug', $region->popular_treks)
                ->where('is_active', true)
                ->get();
        }

        return response()->json($region);
    }
}
