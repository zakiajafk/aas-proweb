<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $recentBookings = Booking::with('user')
            ->orderBy('booking_time', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('recentBookings'));
    }

    public function customers()
    {
        $bookings = Booking::with('user')
            ->orderBy('booking_time', 'desc')
            ->paginate(20);

        return view('admin.customers', compact('bookings'));
    }

    public function revenue()
    {
        $monthlyRevenue = Booking::select(
            DB::raw('MONTHNAME(booking_time) as month'),
            DB::raw('COUNT(*) as total_bookings'),
            DB::raw('SUM(CASE 
                WHEN service = "Premium cut" THEN 50000
                WHEN service = "Barbetro cut" THEN 75000
                WHEN service = "Barbetro VIP" THEN 100000
                WHEN service = "Kids cut" THEN 50000
                WHEN service = "Barbetro hair wash" THEN 10000
                WHEN service = "Professional shaving" THEN 30000
                WHEN service = "Basic hair color" THEN 100000
                WHEN service = "Fashion hair color" THEN 200000
                WHEN service = "Facial" THEN 20000
                WHEN service = "Barbetro VIP + Kid cut" THEN 140000
                WHEN service = "Barbetro Adult + Kid cut" THEN 140000
                WHEN service = "Premium Adult + Kid cut" THEN 90000
                ELSE 0 END) as total_revenue')
        )
        ->groupBy(DB::raw('MONTH(booking_time)'), DB::raw('MONTHNAME(booking_time)'))
        ->orderBy(DB::raw('MONTH(booking_time)'))
        ->get();

        return view('admin.revenue', compact('monthlyRevenue'));
    }
}