<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarouselSlide;
use Illuminate\Support\Facades\URL;

class CarouselSlideController extends Controller
{
    public function index()
    {
        $slides = CarouselSlide::where('is_active', true)
            ->orderBy('sort_order')
            ->get(['id', 'type', 'src', 'poster', 'alt']);
        
        // Convert storage paths to full URLs
        foreach ($slides as $slide) {
            if ($slide->src && str_starts_with($slide->src, '/storage/')) {
                $slide->src = URL::to($slide->src);
            }
            if ($slide->poster && str_starts_with($slide->poster, '/storage/')) {
                $slide->poster = URL::to($slide->poster);
            }
        }
        
        return response()->json($slides);
    }
}
