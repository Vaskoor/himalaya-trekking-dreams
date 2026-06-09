@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Manage Treks</h2>
    <a href="{{ route('admin.treks.create') }}" class="bg-amber-600 text-white px-4 py-2 rounded hover:bg-amber-700">+ Add New Trek</a>
</div>

<table class="min-w-full bg-white rounded-lg shadow">
    <thead>
        <tr class="border-b">
            <th class="px-4 py-3 text-left">ID</th>
            <th class="px-4 py-3 text-left">Name</th>
            <th class="px-4 py-3 text-left">Region</th>
            <th class="px-4 py-3 text-left">Duration</th>
            <th class="px-4 py-3 text-left">Price</th>
            <th class="px-4 py-3 text-left">Featured</th>
            <th class="px-4 py-3 text-left">Sort</th>
            <th class="px-4 py-3 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($treks as $trek)
        <tr class="border-b hover:bg-gray-50">
            <td class="px-4 py-2">{{ $trek->id }}</td>
            <td class="px-4 py-2">{{ $trek->name }}</td>
            <td class="px-4 py-2">{{ $trek->region->name ?? '' }}</td>
            <td class="px-4 py-2">{{ $trek->duration }}</td>
            <td class="px-4 py-2">${{ $trek->price }}</td>
            <td class="px-4 py-2">{{ $trek->is_featured ? 'Yes' : 'No' }}</td>
            <td class="px-4 py-2">{{ $trek->sort_order }}</td>
            <td class="px-4 py-2">
                <a href="{{ route('admin.treks.edit', $trek) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                <form action="{{ route('admin.treks.destroy', $trek) }}" method="POST" class="inline" onsubmit="return confirm('Delete this trek?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                </form>
            </td>
        <tr>
        @endforeach
    </tbody>
</table>
<div class="mt-4">{{ $treks->links() }}</div>
@endsection
