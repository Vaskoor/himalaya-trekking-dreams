<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Storage;

class GalleryImageController extends Controller
{
    public function index()
    {
        $images = GalleryImage::where('is_active', true)->orderBy('sort_order')->get();
        
        // Transform each image to include the full public URL
        $images->transform(function ($image) {
            if ($image->image_path) {
                // If it's already a full URL, leave it; otherwise, generate storage URL
                if (!filter_var($image->image_path, FILTER_VALIDATE_URL)) {
                    $image->image_path = Storage::url($image->image_path);
                }
            }
            return $image;
        });
        
        return response()->json($images);
    }

    public function show($id)
    {
        $image = GalleryImage::findOrFail($id);
        if ($image->image_path && !filter_var($image->image_path, FILTER_VALIDATE_URL)) {
            $image->image_path = Storage::url($image->image_path);
        }
        return response()->json($image);
    }
}
