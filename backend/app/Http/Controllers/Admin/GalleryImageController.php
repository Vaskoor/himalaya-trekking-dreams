<?php

namespace App\Http\Controllers\Admin;

use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryImageController extends AdminController
{
    public function index()
    {
        $items = GalleryImage::orderBy('sort_order')->paginate(20);
        return view('admin.gallery.index', compact('items'));
    }

    public function create()
    {
        return view('admin.gallery.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image_path' => 'required|image|max:2048',
            'title' => 'nullable|string',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);
        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('gallery', 'public');
        }
        GalleryImage::create($validated);
        return redirect()->route('admin.gallery.index')->with('success', 'Image added.');
    }

    public function edit($id)
    {
        $item = GalleryImage::findOrFail($id);
        return view('admin.gallery.form', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = GalleryImage::findOrFail($id);
        $validated = $request->validate([
            'title' => 'nullable|string',
            'location' => 'nullable|string',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);
        if ($request->hasFile('image_path')) {
            $request->validate(['image_path' => 'image|max:2048']);
            if ($item->image_path) Storage::disk('public')->delete($item->image_path);
            $validated['image_path'] = $request->file('image_path')->store('gallery', 'public');
        }
        $item->update($validated);
        return redirect()->route('admin.gallery.index')->with('success', 'Image updated.');
    }

    public function destroy($id)
    {
        $item = GalleryImage::findOrFail($id);
        if ($item->image_path) Storage::disk('public')->delete($item->image_path);
        $item->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Image deleted.');
    }
}
