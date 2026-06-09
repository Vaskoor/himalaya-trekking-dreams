@extends('admin.layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-6">{{ isset($item) ? 'Edit Gallery Image' : 'Create Gallery Image' }}</h2>
    <form method="POST" action="{{ isset($item) ? route('admin.gallery.update', $item->id) : route('admin.gallery.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($item)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block font-medium mb-1">Image *</label>
                <input type="file" name="image_path" accept="image/*" class="w-full border rounded px-3 py-2" required="{{ isset($item) ? '' : 'required' }}">
                @if(isset($item) && $item->image_path)
                    <div class="mt-2"><img src="{{ Storage::url($item->image_path) }}" class="h-20 w-auto object-cover rounded"></div>
                @endif
            </div>
            <div>
                <label class="block font-medium mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Location</label>
                <input type="text" name="location" value="{{ old('location', $item->location ?? '') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div class="md:col-span-2">
                <label class="block font-medium mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full border rounded px-3 py-2">{{ old('description', $item->description ?? '') }}</textarea>
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
            <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded hover:bg-amber-700">Save Image</button>
            <a href="{{ route('admin.gallery.index') }}" class="ml-3 text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
