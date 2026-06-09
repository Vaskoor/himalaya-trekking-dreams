<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::where('is_active', true)
            ->where('published_at', '<=', now());
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }
        if ($request->has('tag')) {
            $query->whereJsonContains('tags', $request->tag);
        }
        $blogs = $query->orderBy('published_at', 'desc')
            ->orderBy('sort_order')
            ->paginate($request->per_page ?? 12);
        return response()->json($blogs);
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        return response()->json($blog);
    }
}
