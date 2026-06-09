@extends('admin.layouts.app')
@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-6">{{ isset($comparison) ? 'Edit Comparison' : 'Create Comparison' }}</h2>
    <form method="POST" action="{{ isset($comparison) ? route('admin.comparisons.update', $comparison) : route('admin.comparisons.store') }}" enctype="multipart/form-data">
        @csrf @if(isset($comparison)) @method('PUT') @endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div><label>Slug *</label><input type="text" name="slug" value="{{ old('slug', $comparison->slug ?? '') }}" class="w-full border rounded px-3 py-2" required></div>
            <div><label>Author</label><input type="text" name="author" value="{{ old('author', $comparison->author ?? '') }}" class="w-full border rounded px-3 py-2"></div>
            <div><label>Published At</label><input type="date" name="published_at" value="{{ old('published_at', isset($comparison) && $comparison->published_at ? $comparison->published_at->format('Y-m-d') : '') }}" class="w-full border rounded px-3 py-2"></div>
            <div><label>Sort Order</label><input type="number" name="sort_order" value="{{ old('sort_order', $comparison->sort_order ?? 0) }}" class="w-full border rounded px-3 py-2"></div>
            <div><label>Featured Image</label><input type="file" name="featured_image" class="w-full border rounded px-3 py-2"></div>
        </div>
        <hr class="my-6">
        @php $locales = ['en','de','fr','es','jp']; @endphp
        @foreach($locales as $locale)
        <div class="border p-3 mb-3 rounded">
            <h4 class="font-bold">{{ strtoupper($locale) }}</h4>
            <label>Title *</label><input type="text" name="title[{{ $locale }}]" value="{{ old("title.$locale", isset($comparison) ? $comparison->getTranslation('title', $locale, false) : '') }}" class="w-full border rounded px-3 py-2 mb-2" required>
            <label>Excerpt *</label><textarea name="excerpt[{{ $locale }}]" rows="2" class="w-full border rounded px-3 py-2 mb-2">{{ old("excerpt.$locale", isset($comparison) ? $comparison->getTranslation('excerpt', $locale, false) : '') }}</textarea>
            <label>Content</label><textarea name="content[{{ $locale }}]" rows="4" class="w-full border rounded px-3 py-2 mb-2">{{ old("content.$locale", isset($comparison) ? $comparison->getTranslation('content', $locale, false) : '') }}</textarea>
            <label>Verdict</label><textarea name="verdict[{{ $locale }}]" rows="2" class="w-full border rounded px-3 py-2">{{ old("verdict.$locale", isset($comparison) ? $comparison->getTranslation('verdict', $locale, false) : '') }}</textarea>
        </div>
        @endforeach
        <div class="mt-4"><label>Comparison Points (JSON)</label><textarea name="comparison_points" rows="6" class="w-full border rounded px-3 py-2 font-mono text-sm" placeholder='[{"point":"Duration","a_value":"14 days","b_value":"11 days","winner":"a"}]'>{{ old('comparison_points', isset($comparison) ? json_encode($comparison->comparison_points, JSON_PRETTY_PRINT) : '') }}</textarea></div>
        <div class="mt-4"><label><input type="checkbox" name="is_active" value="1" {{ old('is_active', isset($comparison) ? $comparison->is_active : true) ? 'checked' : '' }}> Active</label></div>
        <div class="mt-6"><button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded">Save Comparison</button></div>
    </form>
</div>
@endsection
