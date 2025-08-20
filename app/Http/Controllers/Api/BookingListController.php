<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingListController extends Controller
{
    //GET /api/bookings - list user's bookings
    public function index()
    {
        $bookings = Booking::with('service')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Your bookings',
            'data' => $bookings
        ]);
    }

    // POST /api/bookings - book a service
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id'   => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
        ]);

        $booking = Booking::create([
            'user_id'      => Auth::id(),
            'service_id'   => $validated['service_id'],
            'booking_date' => $validated['booking_date'],
            'status'       => 'pending', // default status
        ]);

        return response()->json([
            'message' => 'Booking created successfully',
            'data' => $booking
        ], 201);
    }
}
