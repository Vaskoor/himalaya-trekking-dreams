@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold">Blog Articles</h2>
    <a href="{{ route('admin.blogs.create') }}" class="bg-amber-600 text-white px-4 py-2 rounded hover:bg-amber-700">+ Add Article</a>
</div>

<table class="min-w-full bg-white rounded-lg shadow">
    <thead>
        <tr><th>ID</th><th>Title</th><th>Category</th><th>Published</th><th>Sort</th><th>Active</th><th>Actions</th></tr>
    </thead>
    <tbody>
        @foreach($blogs as $blog)
        <tr class="border-b">
            <td class="px-4 py-2">{{ $blog->id }}</td>
            <td class="px-4 py-2">{{ $blog->title }}</td>
            <td class="px-4 py-2">{{ $blog->category }}</td>
            <td class="px-4 py-2">{{ $blog->published_at?->format('Y-m-d') }}</td>
            <td class="px-4 py-2">{{ $blog->sort_order }}</td>
            <td class="px-4 py-2">{{ $blog->is_active ? 'Yes' : 'No' }}</td>
            <td class="px-4 py-2">
                <a href="{{ route('admin.blogs.edit', $blog) }}" class="text-blue-600 hover:underline">Edit</a>
                <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="inline" onsubmit="return confirm('Delete?');">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:underline ml-2">Delete</button></form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-4">{{ $blogs->links() }}</div>
@endsection
