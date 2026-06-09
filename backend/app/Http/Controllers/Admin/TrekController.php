<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trek;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrekController extends AdminController
{
    public function index()
    {
        $treks = Trek::with('region')->orderBy('sort_order')->paginate(20);
        return view('admin.treks.index', compact('treks'));
    }

    public function create()
    {
        $regions = Region::all();
        return view('admin.treks.form', compact('regions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|unique:treks',
            'duration' => 'required',
            'price' => 'required|numeric',
            'region_id' => 'required|exists:regions,id',
            'name' => 'required|array',
        ]);
        // Simplified for brevity – full implementation in previous scripts
        Trek::create($validated);
        return redirect()->route('admin.treks.index')->with('success', 'Trek created.');
    }

    public function edit(Trek $trek)
    {
        $regions = Region::all();
        return view('admin.treks.form', compact('trek', 'regions'));
    }

    public function update(Request $request, Trek $trek)
    {
        $validated = $request->validate([
            'slug' => 'required|unique:treks,slug,'.$trek->id,
            'duration' => 'required',
            'price' => 'required|numeric',
            'region_id' => 'required|exists:regions,id',
        ]);
        $trek->update($validated);
        return redirect()->route('admin.treks.index')->with('success', 'Trek updated.');
    }

    public function destroy(Trek $trek)
    {
        $trek->delete();
        return redirect()->route('admin.treks.index')->with('success', 'Trek deleted.');
    }
}
