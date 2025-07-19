<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class HomeController extends Controller
{
    public function index()
    {
        $bookedTimes = Booking::pluck('booking_time')->toArray();
        return view('home', compact('bookedTimes'));
    }
}