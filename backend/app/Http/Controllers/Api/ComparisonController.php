<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comparison;
use Illuminate\Http\Request;

class ComparisonController extends Controller
{
    public function index(Request $request)
    {
        $query = Comparison::where('is_active', true)
            ->where('published_at', '<=', now());
        if ($request->has('type')) {
            $query->where('item_a_type', $request->type)
                  ->orWhere('item_b_type', $request->type);
        }
        $comparisons = $query->orderBy('sort_order')
            ->orderBy('published_at', 'desc')
            ->paginate($request->per_page ?? 12);
        return response()->json($comparisons);
    }

    public function show($slug)
    {
        $comparison = Comparison::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Load related models if they exist
        $comparison->itemA = $comparison->itemA();
        $comparison->itemB = $comparison->itemB();

        return response()->json($comparison);
    }
}
