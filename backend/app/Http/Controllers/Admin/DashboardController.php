<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trek;
use App\Models\Activity;
use App\Models\Booking;
use App\Models\NewsletterSubscriber;

class DashboardController extends AdminController
{
    public function index()
    {
        $stats = [
            'treks' => Trek::count(),
            'activities' => Activity::count(),
            'bookings' => Booking::count(),
            'subscribers' => NewsletterSubscriber::count(),
        ];
        $recentBookings = Booking::with('trek')->latest()->limit(5)->get();
        return view('admin.dashboard', compact('stats', 'recentBookings'));
    }
}
