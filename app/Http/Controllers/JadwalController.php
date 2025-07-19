<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class JadwalController extends Controller
{
    public function index()
    {
        // Ambil semua booking user saat ini (opsional)
        $bookings = Booking::where('user_id', auth()->id())->get();

        return view('jadwal.index', compact('bookings'));
    }
}
