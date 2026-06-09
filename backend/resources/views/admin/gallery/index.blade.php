@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Manage Gallery</h2>
    <a href="{{ route('admin.gallery.create') }}" class="bg-amber-600 text-white px-4 py-2 rounded hover:bg-amber-700">+ Add New</a>
</div>

<table class="min-w-full bg-white rounded-lg shadow">
    <thead>
        <tr><th class="px-4 py-3 text-left">ID</th><th class="px-4 py-3 text-left">Image</th><th class="px-4 py-3 text-left">Title</th><th class="px-4 py-3 text-left">Location</th><th class="px-4 py-3 text-left">Sort</th><th class="px-4 py-3 text-left">Active</th><th class="px-4 py-3 text-left">Actions</th></tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        <tr class="border-b hover:bg-gray-50">
            <td class="px-4 py-2">{{ $item->id }}</td>
            <td class="px-4 py-2">
                @if($item->image_path)
                    <img src="{{ Storage::url($item->image_path) }}" class="h-12 w-auto object-cover rounded" alt="{{ $item->title }}">
                @else
                    <span class="text-gray-400">No image</span>
                @endif
            </td>
            <td class="px-4 py-2">{{ $item->title }}</td>
            <td class="px-4 py-2">{{ $item->location }}</td>
            <td class="px-4 py-2">{{ $item->sort_order }}</td>
            <td class="px-4 py-2">{{ $item->is_active ? 'Yes' : 'No' }}</td>
            <td class="px-4 py-2">
                <a href="{{ route('admin.gallery.edit', $item) }}" class="text-blue-600 hover:underline">Edit</a>
                <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Delete this image?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline ml-2">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-4">{{ $items->links() }}</div>
@endsection
