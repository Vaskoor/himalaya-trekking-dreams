@extends('admin.layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-6">{{ isset($item) ? 'Edit Team Member' : 'Create Team Member' }}</h2>
    <form method="POST" action="{{ isset($item) ? route('admin.team-members.update', $item->id) : route('admin.team-members.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($item)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-medium mb-1">Name *</label>
                <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium mb-1">Role *</label>
                <input type="text" name="role" value="{{ old('role', $item->role ?? '') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="md:col-span-2">
                <label class="block font-medium mb-1">Bio *</label>
                <textarea name="bio" rows="4" class="w-full border rounded px-3 py-2" required>{{ old('bio', $item->bio ?? '') }}</textarea>
            </div>
            <div>
                <label class="block font-medium mb-1">Experience</label>
                <input type="text" name="experience" value="{{ old('experience', $item->experience ?? '') }}" class="w-full border rounded px-3 py-2" placeholder="e.g., 18 Years">
            </div>
            <div>
                <label class="block font-medium mb-1">Icon Emoji</label>
                <input type="text" name="icon_emoji" value="{{ old('icon_emoji', $item->icon_emoji ?? '') }}" class="w-full border rounded px-3 py-2" placeholder="e.g., 🏔️">
            </div>
            <div>
                <label class="block font-medium mb-1">Photo</label>
                <input type="file" name="photo_path" accept="image/*" class="w-full border rounded px-3 py-2">
                @if(isset($item) && $item->photo_path)
                    <div class="mt-2"><img src="{{ Storage::url($item->photo_path) }}" class="h-20 w-auto object-cover"></div>
                @endif
            </div>
            <div>
                <label class="block font-medium mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="flex items-center gap-4 mt-6">
            <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', isset($item) ? $item->is_active : true) ? 'checked' : '' }}> Active</label>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded hover:bg-amber-700">Save Team Member</button>
            <a href="{{ route('admin.team-members.index') }}" class="ml-3 text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
