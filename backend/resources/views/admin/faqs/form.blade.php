@extends('admin.layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-6">{{ isset($item) ? 'Edit FAQ' : 'Create FAQ' }}</h2>
    <form method="POST" action="{{ isset($item) ? route('admin.faqs.update', $item->id) : route('admin.faqs.store') }}">
        @csrf
        @if(isset($item)) @method('PUT') @endif

        <div class="grid grid-cols-1 gap-6">
            <div>
                <label class="block font-medium mb-1">Category</label>
                <input type="text" name="category" value="{{ old('category', $item->category ?? '') }}" class="w-full border rounded px-3 py-2" placeholder="e.g., Booking, Trekking, etc.">
            </div>

            <hr>
            <h3 class="text-lg font-bold">Question & Answer (Translatable)</h3>

            @php $locales = ['en', 'de', 'fr', 'es', 'jp']; @endphp
            @foreach($locales as $locale)
                <div class="border rounded p-4">
                    <h4 class="font-bold mb-2">{{ strtoupper($locale) }}</h4>
                    <div class="mb-3">
                        <label class="block text-sm font-medium mb-1">Question</label>
                        <textarea name="question[{{ $locale }}]" rows="2" class="w-full border rounded px-3 py-2" required>{{ old("question.$locale", isset($item) ? (json_decode($item->question, true)[$locale] ?? '') : '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Answer</label>
                        <textarea name="answer[{{ $locale }}]" rows="4" class="w-full border rounded px-3 py-2" required>{{ old("answer.$locale", isset($item) ? (json_decode($item->answer, true)[$locale] ?? '') : '') }}</textarea>
                    </div>
                </div>
            @endforeach

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium mb-1">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block font-medium mb-1">&nbsp;</label>
                    <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', isset($item) ? $item->is_active : true) ? 'checked' : '' }}> Active</label>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-amber-600 text-white px-6 py-2 rounded hover:bg-amber-700">Save FAQ</button>
            <a href="{{ route('admin.faqs.index') }}" class="ml-3 text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
