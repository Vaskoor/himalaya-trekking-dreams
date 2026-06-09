<?php

namespace App\Http\Controllers\Admin;

use App\Models\CarouselSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselSlideController extends AdminController
{
    public function index()
    {
        $slides = CarouselSlide::orderBy('sort_order')->paginate(20);
        return view('admin.carousel-slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.carousel-slides.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:image,video',
            'src' => 'nullable|string',         // optional, if file is uploaded
            'src_file' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov|max:20480', // 20MB max
            'poster' => 'nullable|string',
            'poster_file' => 'nullable|image|max:5120',
            'alt' => 'nullable|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        // Handle main source file upload
        if ($request->hasFile('src_file')) {
            $path = $request->file('src_file')->store('carousel', 'public');
            $validated['src'] = Storage::url($path);
        } elseif (!$validated['src']) {
            return back()->withErrors(['src' => 'Either provide a URL or upload a file.']);
        }

        // Handle poster upload
        if ($request->hasFile('poster_file')) {
            $path = $request->file('poster_file')->store('carousel', 'public');
            $validated['poster'] = Storage::url($path);
        }

        CarouselSlide::create($validated);
        return redirect()->route('admin.carousel-slides.index')->with('success', 'Slide created.');
    }

    public function edit(CarouselSlide $carouselSlide)
    {
        return view('admin.carousel-slides.form', ['item' => $carouselSlide]);
    }

    public function update(Request $request, CarouselSlide $carouselSlide)
    {
        $validated = $request->validate([
            'type' => 'required|in:image,video',
            'src' => 'nullable|string',
            'src_file' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,mov|max:20480',
            'poster' => 'nullable|string',
            'poster_file' => 'nullable|image|max:5120',
            'alt' => 'nullable|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        // Replace source if new file uploaded
        if ($request->hasFile('src_file')) {
            // Delete old file if exists
            if ($carouselSlide->src && str_contains($carouselSlide->src, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $carouselSlide->src);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('src_file')->store('carousel', 'public');
            $validated['src'] = Storage::url($path);
        } elseif (empty($validated['src']) && !$carouselSlide->src) {
            return back()->withErrors(['src' => 'Either provide a URL or upload a file.']);
        }

        // Replace poster if new file uploaded
        if ($request->hasFile('poster_file')) {
            if ($carouselSlide->poster && str_contains($carouselSlide->poster, '/storage/')) {
                $oldPoster = str_replace('/storage/', '', $carouselSlide->poster);
                Storage::disk('public')->delete($oldPoster);
            }
            $path = $request->file('poster_file')->store('carousel', 'public');
            $validated['poster'] = Storage::url($path);
        }

        $carouselSlide->update($validated);
        return redirect()->route('admin.carousel-slides.index')->with('success', 'Slide updated.');
    }

    public function destroy(CarouselSlide $carouselSlide)
    {
        // Delete associated files
        if ($carouselSlide->src && str_contains($carouselSlide->src, '/storage/')) {
            $oldPath = str_replace('/storage/', '', $carouselSlide->src);
            Storage::disk('public')->delete($oldPath);
        }
        if ($carouselSlide->poster && str_contains($carouselSlide->poster, '/storage/')) {
            $oldPoster = str_replace('/storage/', '', $carouselSlide->poster);
            Storage::disk('public')->delete($oldPoster);
        }
        $carouselSlide->delete();
        return redirect()->route('admin.carousel-slides.index')->with('success', 'Slide deleted.');
    }
}