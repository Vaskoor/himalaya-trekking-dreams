<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SeasonalGuide;
use Illuminate\Http\Request;

class SeasonalGuideController extends Controller
{
    public function index()
    {
        $guides = SeasonalGuide::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
        return response()->json($guides);
    }

    public function show($slug)
    {
        $guide = SeasonalGuide::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        return response()->json($guide);
    }
}
