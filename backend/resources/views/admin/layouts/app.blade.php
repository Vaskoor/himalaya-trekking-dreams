<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-link.active { background-color: #f3f4f6; color: #1f2937; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <div class="p-4 border-b">
                <h1 class="text-xl font-bold text-amber-700">Admin Panel</h1>
            </div>
            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link block px-4 py-2 rounded hover:bg-gray-100">Dashboard</a>
                <a href="{{ route('admin.treks.index') }}" class="sidebar-link block px-4 py-2 rounded hover:bg-gray-100">Treks</a>
                <a href="{{ route('admin.gallery.index') }}" class="sidebar-link block px-4 py-2 rounded hover:bg-gray-100">Gallery</a>
                <a href="{{ route('admin.testimonials.index') }}" class="sidebar-link block px-4 py-2 rounded hover:bg-gray-100">Testimonials</a>
                <a href="{{ route('admin.why-choose-us.index') }}" class="sidebar-link block px-4 py-2 rounded hover:bg-gray-100">Why Choose Us</a>
                <a href="{{ route('admin.team-members.index') }}" class="sidebar-link block px-4 py-2 rounded hover:bg-gray-100">Team Members</a>
                <a href="{{ route('admin.faqs.index') }}" class="sidebar-link block px-4 py-2 rounded hover:bg-gray-100">FAQs</a>
                <a href="{{ route('admin.blogs.index') }}" class="sidebar-link block px-4 py-2 rounded hover:bg-gray-100">Blogs</a>
                <a href="{{ route('admin.regions.index') }}" class="sidebar-link block px-4 py-2 rounded hover:bg-gray-100">Regions</a>
                <a href="{{ route('admin.comparisons.index') }}" class="sidebar-link block px-4 py-2 rounded hover:bg-gray-100">Comparisons</a>
                <a href="{{ route('admin.homepage.edit') }}" class="sidebar-link block px-4 py-2 rounded hover:bg-gray-100">Homepage Settings</a>
                <a href="{{ route('admin.carousel-slides.index') }}" class="sidebar-link block px-4 py-2 rounded hover:bg-gray-100">Carousel Slides</a>               <hr class="my-4">
                <hr class="my-4">
                <a href="{{ route('logout') }}" class="block px-4 py-2 rounded text-red-600 hover:bg-red-50" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto">
            <div class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">{{ $errors->first() }}</div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
