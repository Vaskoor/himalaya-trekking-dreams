<?php

namespace App\Http\Controllers\Admin;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends AdminController
{
    public function index()
    {
        $items = TeamMember::orderBy('sort_order')->paginate(20);
        return view('admin.team-members.index', compact('items'));
    }

    public function create()
    {
        return view('admin.team-members.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'role' => 'required|string',
            'bio' => 'required|string',
            'experience' => 'nullable|string',
            'photo_path' => 'nullable|image|max:2048',
            'icon_emoji' => 'nullable|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);
        if ($request->hasFile('photo_path')) {
            $validated['photo_path'] = $request->file('photo_path')->store('team', 'public');
        }
        TeamMember::create($validated);
        return redirect()->route('admin.team-members.index')->with('success', 'Team member added.');
    }

    public function edit($id)
    {
        $item = TeamMember::findOrFail($id);
        return view('admin.team-members.form', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = TeamMember::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string',
            'role' => 'required|string',
            'bio' => 'required|string',
            'experience' => 'nullable|string',
            'icon_emoji' => 'nullable|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);
        if ($request->hasFile('photo_path')) {
            $request->validate(['photo_path' => 'image|max:2048']);
            if ($item->photo_path) Storage::disk('public')->delete($item->photo_path);
            $validated['photo_path'] = $request->file('photo_path')->store('team', 'public');
        }
        $item->update($validated);
        return redirect()->route('admin.team-members.index')->with('success', 'Team member updated.');
    }

    public function destroy($id)
    {
        $item = TeamMember::findOrFail($id);
        if ($item->photo_path) Storage::disk('public')->delete($item->photo_path);
        $item->delete();
        return redirect()->route('admin.team-members.index')->with('success', 'Team member deleted.');
    }
}
