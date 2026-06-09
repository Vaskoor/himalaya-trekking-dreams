@extends('admin.layouts.app')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold">Dashboard</h2>
</div>
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-3xl font-bold text-amber-600">{{ $stats['treks'] }}</div>
        <div class="text-gray-500">Treks</div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-3xl font-bold text-amber-600">{{ $stats['activities'] }}</div>
        <div class="text-gray-500">Activities</div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-3xl font-bold text-amber-600">{{ $stats['bookings'] }}</div>
        <div class="text-gray-500">Bookings</div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="text-3xl font-bold text-amber-600">{{ $stats['subscribers'] }}</div>
        <div class="text-gray-500">Newsletter Subs</div>
    </div>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold mb-4">Recent Bookings</h3>
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr><th class="px-4 py-2 text-left">Booking #</th><th>Trek</th><th>Name</th><th>Date</th><th>Status</th></tr>
        </thead>
        <tbody>
            @foreach($recentBookings as $booking)
            <tr>
                <td class="px-4 py-2">{{ $booking->booking_number }}</td>
                <td class="px-4 py-2">{{ $booking->trek->name ?? '-' }}</td>
                <td class="px-4 py-2">{{ $booking->name }}</td>
                <td class="px-4 py-2">{{ $booking->start_date }}</td>
                <td class="px-4 py-2 capitalize">{{ $booking->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
