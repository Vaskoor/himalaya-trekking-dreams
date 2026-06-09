@extends('admin.layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-6">{{ isset($item) ? 'Edit Testimonial' : 'Create Testimonial' }}</h2>
    <form method="POST" action="{{ isset($item) ? route('admin.testimonials.update', $item->id) : route('admin.testimonials.store') }}">
        @csrf
        @if(isset($item)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-medium mb-1">Author Name *</label>
                <input type="text" name="author_name" value="{{ old('author_name', $item->author_name ?? '') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label class="block font-medium mb-1">Author Country</label>
                <input type="text" name="author_country" value="{{ old('author_country', $item->author_country ?? '') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Platform (e.g., Google, TripAdvisor)</label>
                <input type="text" name="platform" value="{{ old('platform', $item->platform ?? '') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Rating (1-5) *</label>
                <select name="rating" class="w-full border rounded px-3 py-2" required>
                    @for($i=1; $i<=5; $i++)
                        <option value="{{ $i }}" {{ old('rating', $item->rating ?? 5) == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i>1 ? 's' : '' }}</option>
                    @endfor
                </select>
            </div>
            <div class="md:col-span-2">
                <label class="block font-medium mb-1">Title *</label>
                <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="md:col-span-2">
                <label class="block font-medium mb-1">Comment *</label>
                <textarea name="comment" rows="4" class="w-full border rounded px-3 py-2" required>{{ old('comment', $item->comment ?? '') }}</textarea>
            </div>
            <div>
                <label class="block font-medium mb-1">Trek Name (optional)</label>
                <input type="text" name="trek_name" value="{{ old('trek_name', $item->trek_name ?? '') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Date</label>
                <input type="date" name="date" value="{{ old('date', isset($item) && $item->date ? $item->date->format('Y-m-d') : '') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div class="flex items-center gap-4 mt-6">
            <label><input type="checkbox" name="is_approved" value="1" {{ old('is_approved', isset($item) ? $item->is_approved : true) ? 'checked' : '' }}> Approved</label>
            <label><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $item->is_featured ?? false) ? 'checked' : '' }}> Featured</label>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded hover:bg-amber-700">Save Testimonial</button>
            <a href="{{ route('admin.testimonials.index') }}" class="ml-3 text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
