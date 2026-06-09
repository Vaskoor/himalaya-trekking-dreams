@extends('admin.layouts.app')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Comparisons</h2>
    <a href="{{ route('admin.comparisons.create') }}" class="bg-amber-600 text-white px-4 py-2 rounded hover:bg-amber-700">+ Add Comparison</a>
</div>
<table class="min-w-full bg-white rounded-lg shadow">
    <thead><tr><th>ID</th><th>Title</th><th>Items</th><th>Sort</th><th>Active</th><th>Actions</th></tr></thead>
    <tbody>@foreach($comparisons as $c)<tr><td>{{ $c->id }}</td><td>{{ $c->title }}</td><td>{{ $c->item_a_type }} vs {{ $c->item_b_type }}</td><td>{{ $c->sort_order }}</td><td>{{ $c->is_active ? 'Yes' : 'No' }}</td><td><a href="{{ route('admin.comparisons.edit', $c) }}" class="text-blue-600">Edit</a> <form action="{{ route('admin.comparisons.destroy', $c) }}" method="POST" class="inline">@csrf @method('DELETE')<button type="submit" class="text-red-600 ml-2">Delete</button></form></td></tr>@endforeach</tbody>
</table>
<div class="mt-4">{{ $comparisons->links() }}</div>
@endsection
