<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Trek;
use Illuminate\Http\Request;

class TrekController extends Controller
{
    public function index(Request $request)
    {
        $query = Trek::with('region')->where('is_active', true);
        
        if ($request->featured) {
            $query->where('is_featured', true);
        }
        if ($request->popular) {
            $query->where('is_popular', true);
        }
        if ($request->top_destination) {
            $query->where('is_top_destination', true);
        }
        
        $query->orderBy('section_priority', 'asc')->orderBy('sort_order', 'asc');
        
        $treks = $query->paginate($request->per_page ?? 12);
        return response()->json($treks);
    }

    public function show($slug)
    {
        $trek = Trek::with(['region', 'itineraries'])->where('slug', $slug)->firstOrFail();
        return response()->json($trek);
    }
}
