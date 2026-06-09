<?php
namespace App\Http\Controllers\Admin;

use App\Models\Comparison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComparisonController extends AdminController
{
    public function index()
    {
        $comparisons = Comparison::orderBy('sort_order')->paginate(20);
        return view('admin.comparisons.index', compact('comparisons'));
    }

    public function create()
    {
        return view('admin.comparisons.form', ['comparison' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|unique:comparisons',
            'title.*' => 'required|string',
            'excerpt.*' => 'required|string',
            'content.*' => 'nullable|string',
            'item_a_type' => 'nullable|string',
            'item_a_id' => 'nullable|integer',
            'item_b_type' => 'nullable|string',
            'item_b_id' => 'nullable|integer',
            'comparison_points' => 'nullable|array',
            'verdict.*' => 'nullable|string',
            'author' => 'nullable|string',
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('comparisons', 'public');
        }

        $comparison = Comparison::create($validated);
        $locales = ['en','de','fr','es','jp'];
        foreach ($locales as $locale) {
            if ($request->has("title.$locale")) {
                $comparison->setTranslation('title', $locale, $request->input("title.$locale"));
                $comparison->setTranslation('excerpt', $locale, $request->input("excerpt.$locale"));
                if ($request->has("content.$locale")) $comparison->setTranslation('content', $locale, $request->input("content.$locale"));
                if ($request->has("verdict.$locale")) $comparison->setTranslation('verdict', $locale, $request->input("verdict.$locale"));
            }
        }
        $comparison->save();
        return redirect()->route('admin.comparisons.index')->with('success', 'Comparison created.');
    }

    public function edit(Comparison $comparison)
    {
        return view('admin.comparisons.form', compact('comparison'));
    }

    public function update(Request $request, Comparison $comparison)
    {
        $validated = $request->validate([
            'slug' => 'required|unique:comparisons,slug,'.$comparison->id,
            'title.*' => 'required|string',
            'excerpt.*' => 'required|string',
            'content.*' => 'nullable|string',
            'item_a_type' => 'nullable|string',
            'item_a_id' => 'nullable|integer',
            'item_b_type' => 'nullable|string',
            'item_b_id' => 'nullable|integer',
            'comparison_points' => 'nullable|array',
            'verdict.*' => 'nullable|string',
            'author' => 'nullable|string',
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($comparison->featured_image) Storage::disk('public')->delete($comparison->featured_image);
            $validated['featured_image'] = $request->file('featured_image')->store('comparisons', 'public');
        }

        $comparison->update($validated);
        $locales = ['en','de','fr','es','jp'];
        foreach ($locales as $locale) {
            if ($request->has("title.$locale")) {
                $comparison->setTranslation('title', $locale, $request->input("title.$locale"));
                $comparison->setTranslation('excerpt', $locale, $request->input("excerpt.$locale"));
                $comparison->setTranslation('content', $locale, $request->input("content.$locale"));
                $comparison->setTranslation('verdict', $locale, $request->input("verdict.$locale"));
            }
        }
        $comparison->save();
        return redirect()->route('admin.comparisons.index')->with('success', 'Comparison updated.');
    }

    public function destroy(Comparison $comparison)
    {
        if ($comparison->featured_image) Storage::disk('public')->delete($comparison->featured_image);
        $comparison->delete();
        return redirect()->route('admin.comparisons.index')->with('success', 'Comparison deleted.');
    }
}
