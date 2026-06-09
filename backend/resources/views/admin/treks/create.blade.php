@extends('admin.layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-6">{{ isset($trek) ? 'Edit Trek' : 'Create New Trek' }}</h2>
    <form action="{{ isset($trek) ? route('admin.treks.update', $trek) : route('admin.treks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($trek)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div><label class="block font-medium mb-1">Slug *</label><input type="text" name="slug" value="{{ old('slug', $trek->slug ?? '') }}" class="w-full border rounded px-3 py-2" required></div>
            <div><label class="block font-medium mb-1">Duration *</label><input type="text" name="duration" value="{{ old('duration', $trek->duration ?? '') }}" class="w-full border rounded px-3 py-2" required></div>
            <div><label class="block font-medium mb-1">Max Altitude (m)</label><input type="number" name="max_altitude" value="{{ old('max_altitude', $trek->max_altitude ?? '') }}" class="w-full border rounded px-3 py-2"></div>
            <div><label class="block font-medium mb-1">Difficulty</label><input type="text" name="difficulty" value="{{ old('difficulty', $trek->difficulty ?? '') }}" class="w-full border rounded px-3 py-2"></div>
            <div><label class="block font-medium mb-1">Best Season</label><input type="text" name="best_season" value="{{ old('best_season', $trek->best_season ?? '') }}" class="w-full border rounded px-3 py-2"></div>
            <div><label class="block font-medium mb-1">Price (USD) *</label><input type="number" step="0.01" name="price" value="{{ old('price', $trek->price ?? '') }}" class="w-full border rounded px-3 py-2" required></div>
            <div><label class="block font-medium mb-1">Discount Price</label><input type="number" step="0.01" name="discount_price" value="{{ old('discount_price', $trek->discount_price ?? '') }}" class="w-full border rounded px-3 py-2"></div>
            <div><label class="block font-medium mb-1">Group Size</label><input type="text" name="group_size" value="{{ old('group_size', $trek->group_size ?? '') }}" class="w-full border rounded px-3 py-2"></div>
            <div><label class="block font-medium mb-1">Start Point</label><input type="text" name="start_point" value="{{ old('start_point', $trek->start_point ?? '') }}" class="w-full border rounded px-3 py-2"></div>
            <div><label class="block font-medium mb-1">End Point</label><input type="text" name="end_point" value="{{ old('end_point', $trek->end_point ?? '') }}" class="w-full border rounded px-3 py-2"></div>
            <div><label class="block font-medium mb-1">Start / End (display)</label><input type="text" name="start_end" value="{{ old('start_end', $trek->start_end ?? '') }}" class="w-full border rounded px-3 py-2"></div>
            <div><label class="block font-medium mb-1">Region *</label><select name="region_id" class="w-full border rounded px-3 py-2" required>
                <option value="">Select Region</option>
                @foreach($regions as $region)
                    <option value="{{ $region->id }}" {{ (old('region_id', $trek->region_id ?? '') == $region->id) ? 'selected' : '' }}>{{ $region->name }}</option>
                @endforeach
            </select></div>
            <div><label class="block font-medium mb-1">Sort Order</label><input type="number" name="sort_order" value="{{ old('sort_order', $trek->sort_order ?? 0) }}" class="w-full border rounded px-3 py-2"></div>
            <div><label class="block font-medium mb-1">Hero Image</label><input type="file" name="hero_image" accept="image/*" class="w-full border rounded px-3 py-2">
                @if(isset($trek) && $trek->hero_image)<div class="mt-2"><img src="{{ Storage::url($trek->hero_image) }}" class="h-20 w-auto object-cover"></div>@endif
            </div>
        </div>

        <hr class="my-6">
        <h3 class="text-lg font-bold mb-3">Translations</h3>
        <div class="border rounded overflow-hidden">
            @php $locales = ['en', 'de', 'fr', 'es', 'jp']; @endphp
            <div class="flex border-b">
                @foreach($locales as $locale)
                    <button type="button" class="lang-tab px-4 py-2 {{ $loop->first ? 'bg-amber-100 font-semibold' : '' }}" data-lang="{{ $locale }}">{{ strtoupper($locale) }}</button>
                @endforeach
            </div>
            @foreach($locales as $locale)
                <div class="lang-panel p-4 {{ $loop->first ? '' : 'hidden' }}" data-lang="{{ $locale }}">
                    <div class="mb-4"><label class="block font-medium mb-1">Name ({{ $locale }}) *</label><input type="text" name="name[{{ $locale }}]" value="{{ old("name.$locale", isset($trek) ? $trek->getTranslation('name', $locale, false) : '') }}" class="w-full border rounded px-3 py-2" required></div>
                    <div class="mb-4"><label class="block font-medium mb-1">Short Description ({{ $locale }}) *</label><textarea name="short_description[{{ $locale }}]" rows="2" class="w-full border rounded px-3 py-2" required>{{ old("short_description.$locale", isset($trek) ? $trek->getTranslation('short_description', $locale, false) : '') }}</textarea></div>
                    <div class="mb-4"><label class="block font-medium mb-1">Description ({{ $locale }}) *</label><textarea name="description[{{ $locale }}]" rows="5" class="w-full border rounded px-3 py-2" required>{{ old("description.$locale", isset($trek) ? $trek->getTranslation('description', $locale, false) : '') }}</textarea></div>
                    <div><label class="block font-medium mb-1">Tagline ({{ $locale }})</label><input type="text" name="tagline[{{ $locale }}]" value="{{ old("tagline.$locale", isset($trek) ? $trek->getTranslation('tagline', $locale, false) : '') }}" class="w-full border rounded px-3 py-2"></div>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div><label class="block font-medium mb-1">Highlights (JSON array)</label><textarea name="highlights" rows="4" class="w-full border rounded px-3 py-2 font-mono text-sm" placeholder='["Highlight 1", "Highlight 2"]'>{{ old('highlights', isset($trek) ? json_encode($trek->highlights, JSON_PRETTY_PRINT) : '') }}</textarea></div>
            <div><label class="block font-medium mb-1">Places (JSON array of objects)</label><textarea name="places" rows="4" class="w-full border rounded px-3 py-2 font-mono text-sm" placeholder='[{"name":"Lukla","altitude":"2,860m","note":"..."}]'>{{ old('places', isset($trek) ? json_encode($trek->places, JSON_PRETTY_PRINT) : '') }}</textarea></div>
            <div><label class="block font-medium mb-1">Included (JSON array)</label><textarea name="included" rows="4" class="w-full border rounded px-3 py-2 font-mono text-sm">{{ old('included', isset($trek) ? json_encode($trek->included, JSON_PRETTY_PRINT) : '') }}</textarea></div>
            <div><label class="block font-medium mb-1">Excluded (JSON array)</label><textarea name="excluded" rows="4" class="w-full border rounded px-3 py-2 font-mono text-sm">{{ old('excluded', isset($trek) ? json_encode($trek->excluded, JSON_PRETTY_PRINT) : '') }}</textarea></div>
            <div class="md:col-span-2"><label class="block font-medium mb-1">Itinerary (JSON array of objects)</label><textarea name="itinerary" rows="6" class="w-full border rounded px-3 py-2 font-mono text-sm" placeholder='[{"day":1,"title":"Arrive Kathmandu","description":"..."}]'>{{ old('itinerary', isset($trek) ? json_encode($trek->itinerary, JSON_PRETTY_PRINT) : '') }}</textarea></div>
        </div>

        <div class="flex items-center gap-4 mt-6">
            <label><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $trek->is_featured ?? false) ? 'checked' : '' }}> Featured</label>
            <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', $trek->is_active ?? true) ? 'checked' : '' }}> Active</label>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded hover:bg-amber-700">Save Trek</button>
            <a href="{{ route('admin.treks.index') }}" class="ml-3 text-gray-600 hover:underline">Cancel</a>
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
