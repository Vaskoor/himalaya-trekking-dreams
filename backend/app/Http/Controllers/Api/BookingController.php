<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Trek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'trek_id' => 'required|exists:treks,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'country' => 'required|string',
            'start_date' => 'required|date|after:today',
            'number_of_people' => 'required|integer|min:1',
        ]);
        if ($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);
        $trek = Trek::find($request->trek_id);
        $booking = Booking::create([
            'booking_number' => 'BK' . time() . rand(1000,9999),
            'trek_id' => $request->trek_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'start_date' => $request->start_date,
            'number_of_people' => $request->number_of_people,
            'total_amount' => $trek->price * $request->number_of_people,
            'special_requests' => $request->special_requests,
            'status' => 'pending',
        ]);
        return response()->json(['message' => 'Booking created', 'booking' => $booking], 201);
    }
}
