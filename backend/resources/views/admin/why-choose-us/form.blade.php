@extends('admin.layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-6">{{ isset($item) ? 'Edit Why Choose Us Item' : 'Create Why Choose Us Item' }}</h2>
    <form method="POST" action="{{ isset($item) ? route('admin.why-choose-us.update', $item->id) : route('admin.why-choose-us.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($item)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-medium mb-1">Title *</label>
                <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium mb-1">SEO Title (optional)</label>
                <input type="text" name="seo_title" value="{{ old('seo_title', $item->seo_title ?? '') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div class="md:col-span-2">
                <label class="block font-medium mb-1">Description *</label>
                <textarea name="description" rows="4" class="w-full border rounded px-3 py-2" required>{{ old('description', $item->description ?? '') }}</textarea>
            </div>
            <div>
                <label class="block font-medium mb-1">Icon (Lucide icon name, e.g., Users, Shield, Globe, Heart, Clock, Award, Star)</label>
                <input type="text" name="icon" value="{{ old('icon', $item->icon ?? '') }}" class="w-full border rounded px-3 py-2" placeholder="e.g., Users">
                <p class="text-xs text-gray-500 mt-1">Available: Users, Shield, Globe, Heart, Clock, Award, Star, MapPin, Headphones, BadgeCheck</p>
            </div>
            <div>
                <label class="block font-medium mb-1">Stats (JSON array)</label>
                <textarea name="stats" rows="3" class="w-full border rounded px-3 py-2 font-mono text-sm" placeholder='[{"val":"15+","label":"Years guiding"},{"val":"50+","label":"Certified guides"}]'>{{ old('stats', isset($item) ? json_encode($item->stats, JSON_PRETTY_PRINT) : '') }}</textarea>
            </div>
            <div class="md:col-span-2">
                <label class="block font-medium mb-1">Bullets (JSON array of strings)</label>
                <textarea name="bullets" rows="3" class="w-full border rounded px-3 py-2 font-mono text-sm" placeholder='["TAAN certified guides", "Fluent English", "Born in Nepal mountains"]'>{{ old('bullets', isset($item) ? json_encode($item->bullets, JSON_PRETTY_PRINT) : '') }}</textarea>
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
            <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded hover:bg-amber-700">Save Item</button>
            <a href="{{ route('admin.why-choose-us.index') }}" class="ml-3 text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
