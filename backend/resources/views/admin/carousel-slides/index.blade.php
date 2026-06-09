@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Carousel Slides</h2>
    <a href="{{ route('admin.carousel-slides.create') }}" class="bg-amber-600 text-white px-4 py-2 rounded hover:bg-amber-700">+ Add Slide</a>
</div>

<table class="min-w-full bg-white rounded-lg shadow">
    <thead>
        <tr><th class="px-4 py-3">ID</th><th>Type</th><th>Preview</th><th>Src</th><th>Sort</th><th>Active</th><th>Actions</th></tr>
    </thead>
    <tbody>
        @foreach($slides as $slide)
        <tr class="border-b">
            <td class="px-4 py-2">{{ $slide->id }}</td>
            <td class="px-4 py-2">{{ ucfirst($slide->type) }}</td>
            <td class="px-4 py-2">
                @if($slide->type == 'image')
                    <img src="{{ $slide->src }}" class="h-12 w-auto object-cover rounded">
                @else
                    <video src="{{ $slide->src }}" class="h-12 w-auto object-cover rounded"></video>
                @endif
            </td>
            <td class="px-4 py-2">{{ Str::limit($slide->src, 50) }}</td>
            <td class="px-4 py-2">{{ $slide->sort_order }}</td>
            <td class="px-4 py-2">{{ $slide->is_active ? 'Yes' : 'No' }}</td>
            <td class="px-4 py-2">
                <a href="{{ route('admin.carousel-slides.edit', $slide) }}" class="text-blue-600 hover:underline">Edit</a>
                <form action="{{ route('admin.carousel-slides.destroy', $slide) }}" method="POST" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:underline ml-2">Delete</button></form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-4">{{ $slides->links() }}</div>
@endsection