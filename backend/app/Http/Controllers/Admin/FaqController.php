<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends AdminController
{
    public function index()
    {
        $items = Faq::orderBy('sort_order')->paginate(20);
        return view('admin.faqs.index', compact('items'));
    }

    public function create()
    {
        return view('admin.faqs.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'nullable|string',
            'question' => 'required|array',
            'answer' => 'required|array',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);
        $validated['question'] = json_encode($validated['question']);
        $validated['answer'] = json_encode($validated['answer']);
        Faq::create($validated);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created.');
    }

    public function edit($id)
    {
        $item = Faq::findOrFail($id);
        return view('admin.faqs.form', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Faq::findOrFail($id);
        $validated = $request->validate([
            'category' => 'nullable|string',
            'question' => 'required|array',
            'answer' => 'required|array',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);
        $validated['question'] = json_encode($validated['question']);
        $validated['answer'] = json_encode($validated['answer']);
        $item->update($validated);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated.');
    }

    public function destroy($id)
    {
        Faq::findOrFail($id)->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted.');
    }
}
