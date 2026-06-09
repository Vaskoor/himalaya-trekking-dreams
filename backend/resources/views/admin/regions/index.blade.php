@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Regions</h2>
    <a href="{{ route('admin.regions.create') }}" class="bg-amber-600 text-white px-4 py-2 rounded hover:bg-amber-700">+ Add Region</a>
</div>

<table class="min-w-full bg-white rounded-lg shadow">
    <thead>
        <tr><th class="px-4 py-3">ID</th><th>Name</th><th>Slug</th><th>Sort</th><th>Active</th><th>Actions</th></tr>
    </thead>
    <tbody>
        @foreach($regions as $region)
        <tr class="border-b">
            <td class="px-4 py-2">{{ $region->id }}</td>
            <td class="px-4 py-2">{{ $region->name }}</td>
            <td class="px-4 py-2">{{ $region->slug }}</td>
            <td class="px-4 py-2">{{ $region->sort_order }}</td>
            <td class="px-4 py-2">{{ $region->is_active ? 'Yes' : 'No' }}</td>
            <td class="px-4 py-2">
                <a href="{{ route('admin.regions.edit', $region) }}" class="text-blue-600 hover:underline">Edit</a>
                <form action="{{ route('admin.regions.destroy', $region) }}" method="POST" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:underline ml-2">Delete</button></form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-4">{{ $regions->links() }}</div>
@endsection
