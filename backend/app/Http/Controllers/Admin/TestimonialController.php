<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends AdminController
{
    public function index()
    {
        $items = Testimonial::orderBy('sort_order')->paginate(20);
        return view('admin.testimonials.index', compact('items'));
    }

    public function create()
    {
        return view('admin.testimonials.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'author_name' => 'required|string',
            'author_country' => 'nullable|string',
            'platform' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string',
            'comment' => 'required|string',
            'trek_name' => 'nullable|string',
            'date' => 'nullable|date',
            'is_approved' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
        ]);
        Testimonial::create($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created.');
    }

    public function edit($id)
    {
        $item = Testimonial::findOrFail($id);
        return view('admin.testimonials.form', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Testimonial::findOrFail($id);
        $validated = $request->validate([
            'author_name' => 'required|string',
            'author_country' => 'nullable|string',
            'platform' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string',
            'comment' => 'required|string',
            'trek_name' => 'nullable|string',
            'date' => 'nullable|date',
            'is_approved' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
        ]);
        $item->update($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated.');
    }

    public function destroy($id)
    {
        Testimonial::findOrFail($id)->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted.');
    }
}
