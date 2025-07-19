<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookedSlots = Booking::pluck('booking_time')
            ->map(function ($time) {
                return Carbon::parse($time)->format('Y-m-d H:i');
            })
            ->toArray();

        return view('booking.index', compact('bookedSlots'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_time' => 'required|date',
            'service' => 'required|string',
            'location' => 'required|string',
        ]);

        // Cek apakah waktu sudah dibooking
        $exists = Booking::where('booking_time', $validated['booking_time'])->exists();
        
        if ($exists) {
            return back()->with('error', 'Waktu tersebut sudah dibooking. Silakan pilih waktu lain.');
        }

        Booking::create([
            'user_id' => auth()->id(),
            'booking_time' => $validated['booking_time'],
            'service' => $validated['service'],
            'location' => $validated['location'],
        ]);

        // Tambahan perbaikan:
        return redirect()->route('home')->with([
            'success' => 'Booking berhasil!',
            'success_booking' => true // untuk modal berhasil
        ]);
    }

    public function destroy($id)
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        
        $booking->delete();

        return redirect()->route('jadwal')->with('success', 'Booking berhasil dihapus!');
    }
}
