<?php

namespace App\Http\Controllers\Admin;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegionController extends AdminController
{
    public function index()
    {
        $regions = Region::orderBy('sort_order')->paginate(20);
        return view('admin.regions.index', compact('regions'));
    }

    public function create()
    {
        return view('admin.regions.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|unique:regions',
            'name.*' => 'required|string',
            'description.*' => 'nullable|string',
            'short_description.*' => 'nullable|string',
            'best_season' => 'nullable|string',
            'difficulty' => 'nullable|string',
            'popular_treks' => 'nullable|array',
            'highlights' => 'nullable|array',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'hero_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')->store('regions', 'public');
        }

        $region = Region::create($validated);

        $locales = ['en', 'de', 'fr', 'es', 'jp'];
        foreach ($locales as $locale) {
            if ($request->has("name.$locale")) {
                $region->setTranslation('name', $locale, $request->input("name.$locale"));
                if ($request->has("description.$locale")) {
                    $region->setTranslation('description', $locale, $request->input("description.$locale"));
                }
                if ($request->has("short_description.$locale")) {
                    $region->setTranslation('short_description', $locale, $request->input("short_description.$locale"));
                }
            }
        }
        $region->save();

        return redirect()->route('admin.regions.index')->with('success', 'Region created.');
    }

    public function edit(Region $region)
    {
        return view('admin.regions.form', compact('region'));
    }

    public function update(Request $request, Region $region)
    {
        $validated = $request->validate([
            'slug' => 'required|unique:regions,slug,'.$region->id,
            'name.*' => 'required|string',
            'description.*' => 'nullable|string',
            'short_description.*' => 'nullable|string',
            'best_season' => 'nullable|string',
            'difficulty' => 'nullable|string',
            'popular_treks' => 'nullable|array',
            'highlights' => 'nullable|array',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
            'hero_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('hero_image')) {
            if ($region->hero_image) Storage::disk('public')->delete($region->hero_image);
            $validated['hero_image'] = $request->file('hero_image')->store('regions', 'public');
        }

        $region->update($validated);

        $locales = ['en', 'de', 'fr', 'es', 'jp'];
        foreach ($locales as $locale) {
            if ($request->has("name.$locale")) {
                $region->setTranslation('name', $locale, $request->input("name.$locale"));
                $region->setTranslation('description', $locale, $request->input("description.$locale"));
                $region->setTranslation('short_description', $locale, $request->input("short_description.$locale"));
            }
        }
        $region->save();

        return redirect()->route('admin.regions.index')->with('success', 'Region updated.');
    }

    public function destroy(Region $region)
    {
        if ($region->hero_image) Storage::disk('public')->delete($region->hero_image);
        $region->delete();
        return redirect()->route('admin.regions.index')->with('success', 'Region deleted.');
    }
}
