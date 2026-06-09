@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Why Choose Us Items</h2>
    <a href="{{ route('admin.why-choose-us.create') }}" class="bg-amber-600 text-white px-4 py-2 rounded hover:bg-amber-700">+ Add Item</a>
</div>

<table class="min-w-full bg-white rounded-lg shadow">
    <thead>
        <tr><th class="px-4 py-3 text-left">ID</th><th>Title</th><th>Description (short)</th><th>Icon</th><th>Sort</th><th>Active</th><th>Actions</th></tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        <tr>
            <td class="px-4 py-2">{{ $item->id }}</td>
            <td class="px-4 py-2">{{ $item->title }}</td>
            <td class="px-4 py-2">{{ Str::limit($item->description, 50) }}</td>
            <td class="px-4 py-2">{{ $item->icon }}</td>
            <td class="px-4 py-2">{{ $item->sort_order }}</td>
            <td class="px-4 py-2">{{ $item->is_active ? 'Yes' : 'No' }}</td>
            <td class="px-4 py-2">
                <a href="{{ route('admin.why-choose-us.edit', $item) }}" class="text-blue-600 hover:underline">Edit</a>
                <form action="{{ route('admin.why-choose-us.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:underline ml-2">Delete</button></form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-4">{{ $items->links() }}</div>
@endsection
