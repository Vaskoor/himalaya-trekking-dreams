@extends('admin.layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-6">{{ isset($item) ? 'Edit Region' : 'Create Region' }}</h2>
    <form method="POST" action="{{ isset($item) ? route('admin.regions.update', $item->id) : route('admin.regions.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($item)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div><label>Slug *</label><input type="text" name="slug" value="{{ old('slug', $item->slug ?? '') }}" class="w-full border rounded px-3 py-2" required></div>
            <div><label>Best Season</label><input type="text" name="best_season" value="{{ old('best_season', $item->best_season ?? '') }}" class="w-full border rounded px-3 py-2"></div>
            <div><label>Difficulty</label><input type="text" name="difficulty" value="{{ old('difficulty', $item->difficulty ?? '') }}" class="w-full border rounded px-3 py-2"></div>
            <div><label>Hero Image</label><input type="file" name="hero_image" class="w-full border rounded px-3 py-2">@if(isset($item) && $item->hero_image)<div class="mt-2"><img src="{{ Storage::url($item->hero_image) }}" class="h-20 w-auto object-cover"></div>@endif</div>
            <div><label>Sort Order</label><input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" class="w-full border rounded px-3 py-2"></div>
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
                    <div><label>Name ({{ $locale }}) *</label><input type="text" name="name[{{ $locale }}]" value="{{ old("name.$locale", isset($item) ? $item->getTranslation('name', $locale, false) : '') }}" class="w-full border rounded px-3 py-2" required></div>
                    <div class="mt-4"><label>Short Description ({{ $locale }})</label><textarea name="short_description[{{ $locale }}]" rows="2" class="w-full border rounded px-3 py-2">{{ old("short_description.$locale", isset($item) ? $item->getTranslation('short_description', $locale, false) : '') }}</textarea></div>
                    <div class="mt-4"><label>Full Description ({{ $locale }})</label><textarea name="description[{{ $locale }}]" rows="5" class="w-full border rounded px-3 py-2">{{ old("description.$locale", isset($item) ? $item->getTranslation('description', $locale, false) : '') }}</textarea></div>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-2 gap-6 mt-6">
            <div><label>Popular Treks (JSON array of trek slugs)</label><textarea name="popular_treks" rows="3" class="w-full border rounded px-3 py-2 font-mono text-sm" placeholder='["everest-base-camp-trek", "gokyo-lakes-trek"]'>{{ old('popular_treks', isset($item) && $item->popular_treks ? json_encode($item->popular_treks, JSON_PRETTY_PRINT) : '') }}</textarea></div>
            <div><label>Highlights (JSON array)</label><textarea name="highlights" rows="3" class="w-full border rounded px-3 py-2 font-mono text-sm" placeholder='["Highest peak in the world", "Sherpa culture"]'>{{ old('highlights', isset($item) && $item->highlights ? json_encode($item->highlights, JSON_PRETTY_PRINT) : '') }}</textarea></div>
            <div class="md:col-span-2"><label>Meta Title</label><input type="text" name="meta_title" value="{{ old('meta_title', $item->meta_title ?? '') }}" class="w-full border rounded px-3 py-2"></div>
            <div class="md:col-span-2"><label>Meta Description</label><textarea name="meta_description" rows="2" class="w-full border rounded px-3 py-2">{{ old('meta_description', $item->meta_description ?? '') }}</textarea></div>
        </div>

        <div class="flex items-center gap-4 mt-6">
            <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', isset($item) ? $item->is_active : true) ? 'checked' : '' }}> Active</label>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded hover:bg-amber-700">Save Region</button>
            <a href="{{ route('admin.regions.index') }}" class="ml-3 text-gray-600 hover:underline">Cancel</a>
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
