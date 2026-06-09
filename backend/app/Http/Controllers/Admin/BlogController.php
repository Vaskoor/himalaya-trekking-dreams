<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends AdminController
{
    public function index()
    {
        $blogs = Blog::orderBy('sort_order')->paginate(20);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|unique:blogs',
            'title.*' => 'required|string',
            'excerpt.*' => 'required|string',
            'content.*' => 'required|string',
            'category' => 'nullable|string',
            'tags' => 'nullable|array',
            'author' => 'nullable|string',
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'sort_order' => 'integer',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }

        $blog = Blog::create($validated);

        $locales = ['en', 'de', 'fr', 'es', 'jp'];
        foreach ($locales as $locale) {
            if ($request->has("title.$locale")) {
                $blog->setTranslation('title', $locale, $request->input("title.$locale"));
                $blog->setTranslation('excerpt', $locale, $request->input("excerpt.$locale"));
                $blog->setTranslation('content', $locale, $request->input("content.$locale"));
            }
        }
        $blog->save();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created.');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.form', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'slug' => 'required|unique:blogs,slug,'.$blog->id,
            'title.*' => 'required|string',
            'excerpt.*' => 'required|string',
            'content.*' => 'required|string',
            'category' => 'nullable|string',
            'tags' => 'nullable|array',
            'author' => 'nullable|string',
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'sort_order' => 'integer',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image) Storage::disk('public')->delete($blog->featured_image);
            $validated['featured_image'] = $request->file('featured_image')->store('blogs', 'public');
        }

        $blog->update($validated);

        $locales = ['en', 'de', 'fr', 'es', 'jp'];
        foreach ($locales as $locale) {
            if ($request->has("title.$locale")) {
                $blog->setTranslation('title', $locale, $request->input("title.$locale"));
                $blog->setTranslation('excerpt', $locale, $request->input("excerpt.$locale"));
                $blog->setTranslation('content', $locale, $request->input("content.$locale"));
            }
        }
        $blog->save();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated.');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->featured_image) Storage::disk('public')->delete($blog->featured_image);
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted.');
    }
}
