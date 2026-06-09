@extends('admin.layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-6">{{ isset($blog) ? 'Edit Article' : 'Create Article' }}</h2>
    <form method="POST" action="{{ isset($blog) ? route('admin.blogs.update', $blog) : route('admin.blogs.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($blog)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div><label>Slug *</label><input type="text" name="slug" value="{{ old('slug', $blog->slug ?? '') }}" class="w-full border rounded px-3 py-2" required></div>
            <div><label>Category</label><input type="text" name="category" value="{{ old('category', $blog->category ?? '') }}" class="w-full border rounded px-3 py-2"></div>
            <div><label>Author</label><input type="text" name="author" value="{{ old('author', $blog->author ?? '') }}" class="w-full border rounded px-3 py-2"></div>
            <div><label>Published At</label><input type="date" name="published_at" value="{{ old('published_at', isset($blog) && $blog->published_at ? $blog->published_at->format('Y-m-d') : '') }}" class="w-full border rounded px-3 py-2"></div>
            <div><label>Sort Order</label><input type="number" name="sort_order" value="{{ old('sort_order', $blog->sort_order ?? 0) }}" class="w-full border rounded px-3 py-2"></div>
            <div><label>Featured Image</label><input type="file" name="featured_image" class="w-full border rounded px-3 py-2">@if(isset($blog) && $blog->featured_image)<div class="mt-2"><img src="{{ Storage::url($blog->featured_image) }}" class="h-20 w-auto object-cover"></div>@endif</div>
        </div>

        <hr class="my-6">
        <h3 class="text-lg font-bold">Translations</h3>
        @php $locales = ['en','de','fr','es','jp']; @endphp
        <div class="border rounded overflow-hidden mt-2">
            <div class="flex border-b">
                @foreach($locales as $locale)
                    <button type="button" class="lang-tab px-4 py-2 {{ $loop->first ? 'bg-amber-100 font-semibold' : '' }}" data-lang="{{ $locale }}">{{ strtoupper($locale) }}</button>
                @endforeach
            </div>
            @foreach($locales as $locale)
                <div class="lang-panel p-4 {{ $loop->first ? '' : 'hidden' }}" data-lang="{{ $locale }}">
                    <div><label>Title ({{ $locale }}) *</label><input type="text" name="title[{{ $locale }}]" value="{{ old("title.$locale", isset($blog) ? $blog->getTranslation('title', $locale, false) : '') }}" class="w-full border rounded px-3 py-2" required></div>
                    <div class="mt-4"><label>Excerpt ({{ $locale }}) *</label><textarea name="excerpt[{{ $locale }}]" rows="2" class="w-full border rounded px-3 py-2" required>{{ old("excerpt.$locale", isset($blog) ? $blog->getTranslation('excerpt', $locale, false) : '') }}</textarea></div>
                    <div class="mt-4"><label>Content ({{ $locale }}) *</label><textarea name="content[{{ $locale }}]" rows="8" class="w-full border rounded px-3 py-2" required>{{ old("content.$locale", isset($blog) ? $blog->getTranslation('content', $locale, false) : '') }}</textarea></div>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-2 gap-6 mt-6">
            <div><label>Tags (JSON array)</label><textarea name="tags" rows="3" class="w-full border rounded px-3 py-2 font-mono text-sm" placeholder='["Trekking", "Everest"]'>{{ old('tags', isset($blog) ? json_encode($blog->tags, JSON_PRETTY_PRINT) : '') }}</textarea></div>
            <div><label>Meta Title</label><input type="text" name="meta_title" value="{{ old('meta_title', $blog->meta_title ?? '') }}" class="w-full border rounded px-3 py-2"></div>
            <div class="md:col-span-2"><label>Meta Description</label><textarea name="meta_description" rows="2" class="w-full border rounded px-3 py-2">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea></div>
        </div>

        <div class="flex items-center gap-4 mt-6">
            <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', isset($blog) ? $blog->is_active : true) ? 'checked' : '' }}> Active</label>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded hover:bg-amber-700">Save Article</button>
            <a href="{{ route('admin.blogs.index') }}" class="ml-3 text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@push('scripts')
<script>
    document.querySelectorAll('.lang-tab').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.lang-tab').forEach(b => b.classList.remove('bg-amber-100', 'font-semibold'));
            this.classList.add('bg-amber-100', 'font-semibold');
            let lang = this.dataset.lang;
            document.querySelectorAll('.lang-panel').forEach(panel => {
                panel.classList.toggle('hidden', panel.dataset.lang !== lang);
            });
        });
    });
</script>
@endpush
@endsection
