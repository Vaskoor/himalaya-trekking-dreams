@extends('admin.layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-6">Homepage Settings</h2>
    <form action="{{ route('admin.homepage.update') }}" method="POST">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label class="block font-medium mb-1">Hero Heading (translatable)</label>
                <div class="border rounded overflow-hidden">
                    @foreach(['en','de','fr','es','jp'] as $locale)
                        <div class="border-b p-3"><strong>{{ strtoupper($locale) }}</strong><input type="text" name="hero_heading[{{ $locale }}]" value="{{ json_decode($settings['hero_heading']->value ?? '{}', true)[$locale] ?? '' }}" class="w-full border rounded px-3 py-2 mt-1"></div>
                    @endforeach
                </div>
            </div>
            <div>
                <label class="block font-medium mb-1">Hero Subheading (translatable)</label>
                <div class="border rounded overflow-hidden">
                    @foreach(['en','de','fr','es','jp'] as $locale)
                        <div class="border-b p-3"><strong>{{ strtoupper($locale) }}</strong><textarea name="hero_subheading[{{ $locale }}]" rows="2" class="w-full border rounded px-3 py-2 mt-1">{{ json_decode($settings['hero_subheading']->value ?? '{}', true)[$locale] ?? '' }}</textarea></div>
                    @endforeach
                </div>
            </div>
            <div>
                <label class="block font-medium mb-1">Hero Video Path</label>
                <input type="text" name="hero_video" value="{{ $settings['hero_video']->value ?? '/videos/vai.mp4' }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block font-medium mb-1">Hero Fallback Image URL</label>
                <input type="text" name="hero_fallback_image" value="{{ $settings['hero_fallback_image']->value ?? 'https://images.pexels.com/photos/417173/pexels-photo-417173.jpeg' }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>
        <div class="mt-6"><button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded">Save Settings</button></div>
    </form>
    <div class="mt-8 border-t pt-6">
    <a href="{{ route('admin.carousel-slides.index') }}" class="bg-amber-600 text-white px-4 py-2 rounded hover:bg-amber-700">Manage Carousel Slides (Images/Videos)</a>
    </div>
</div>
@endsection
