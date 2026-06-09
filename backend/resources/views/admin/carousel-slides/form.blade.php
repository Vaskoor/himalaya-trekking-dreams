@extends('admin.layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-6">{{ isset($item) ? 'Edit Slide' : 'Create Slide' }}</h2>
    <form method="POST" action="{{ isset($item) ? route('admin.carousel-slides.update', $item->id) : route('admin.carousel-slides.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($item)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-medium mb-1">Type *</label>
                <select name="type" class="w-full border rounded px-3 py-2" required>
                    <option value="image" {{ old('type', isset($item) ? $item->type : '') == 'image' ? 'selected' : '' }}>Image</option>
                    <option value="video" {{ old('type', isset($item) ? $item->type : '') == 'video' ? 'selected' : '' }}>Video</option>
                </select>
            </div>
            <div>
                <label class="block font-medium mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" class="w-full border rounded px-3 py-2">
            </div>
            <div class="md:col-span-2">
                <label class="block font-medium mb-1">Source (URL or upload)</label>
                <input type="text" name="src" value="{{ old('src', $item->src ?? '') }}" class="w-full border rounded px-3 py-2 mb-2" placeholder="https://... or /path/to/file">
                <div class="text-sm text-gray-500 mb-2">— OR —</div>
                <input type="file" name="src_file" accept="image/*,video/mp4" class="w-full border rounded px-3 py-2">
                @if(isset($item) && $item->src)
                    <div class="mt-2 text-sm">Current: <a href="{{ $item->src }}" target="_blank" class="text-blue-600">{{ $item->src }}</a></div>
                @endif
            </div>
            <div>
                <label class="block font-medium mb-1">Poster (for video, optional)</label>
                <input type="text" name="poster" value="{{ old('poster', $item->poster ?? '') }}" class="w-full border rounded px-3 py-2 mb-2" placeholder="URL or /path/to/poster">
                <input type="file" name="poster_file" accept="image/*" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Alt text (for image)</label>
                <input type="text" name="alt" value="{{ old('alt', $item->alt ?? '') }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="flex items-center gap-4 mt-6">
            <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', isset($item) ? $item->is_active : true) ? 'checked' : '' }}> Active</label>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded hover:bg-amber-700">Save Slide</button>
            <a href="{{ route('admin.carousel-slides.index') }}" class="ml-3 text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection