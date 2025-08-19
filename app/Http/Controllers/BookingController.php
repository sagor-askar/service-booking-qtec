<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
  // Show all bookings of the logged-in user
    public function index()
    {
        $bookings = Auth::user()
            ->bookings()
            ->with('service')
            ->latest()
            ->get();

        return view('frontend.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $services = Service::where('status', 'active')->get();

        return view('frontend.bookings.create', compact('services'));
    }

    // Store booking
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
        ]);

        Booking::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'booking_date' => $request->booking_date,
            'status' => 'pending', // default
        ]);

        return redirect()->route('bookings.index')
            ->with('success', 'Your booking has been created successfully!');
    }

    // Edit booking
    public function edit(Booking $booking)
    {
        $services = Service::where('status', 'active')->get();
        return view('frontend.bookings.edit', compact('booking', 'services'));
    }

    // Update booking
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
        ]);

        $booking->update([
            'service_id' => $request->service_id,
            'booking_date' => $request->booking_date,
        ]);

        return redirect()->route('bookings.index')
            ->with('success', 'Your booking has been updated successfully!');
    }

    // Delete booking
    public function destroy(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Your booking has been deleted successfully!');
    }
}
