<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $activities = Activity::where('is_active', true)->get();
        return response()->json($activities);
    }

    public function show($slug)
    {
        $activity = Activity::where('slug', $slug)->firstOrFail();
        return response()->json($activity);
    }
}