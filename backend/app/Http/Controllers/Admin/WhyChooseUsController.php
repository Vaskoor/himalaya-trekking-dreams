<?php

namespace App\Http\Controllers\Admin;

use App\Models\WhyChooseUs;
use Illuminate\Http\Request;

class WhyChooseUsController extends AdminController
{
    public function index()
    {
        $items = WhyChooseUs::orderBy('sort_order')->paginate(20);
        return view('admin.why-choose-us.index', compact('items'));
    }

    public function create()
    {
        return view('admin.why-choose-us.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'seo_title' => 'nullable|string',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'stats' => 'nullable|array',
            'bullets' => 'nullable|array',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);
        WhyChooseUs::create($validated);
        return redirect()->route('admin.why-choose-us.index')->with('success', 'Item created.');
    }

    public function edit($id)
    {
        $item = WhyChooseUs::findOrFail($id);
        return view('admin.why-choose-us.form', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = WhyChooseUs::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string',
            'seo_title' => 'nullable|string',
            'description' => 'required|string',
            'icon' => 'nullable|string',
            'stats' => 'nullable|array',
            'bullets' => 'nullable|array',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);
        $item->update($validated);
        return redirect()->route('admin.why-choose-us.index')->with('success', 'Item updated.');
    }

    public function destroy($id)
    {
        WhyChooseUs::findOrFail($id)->delete();
        return redirect()->route('admin.why-choose-us.index')->with('success', 'Item deleted.');
    }
}
