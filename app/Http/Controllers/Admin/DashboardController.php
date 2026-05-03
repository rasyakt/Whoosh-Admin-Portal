<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\MobileUser;
use App\Models\Station;
use App\Models\Train;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => MobileUser::on('sqlsrv')->count(),
            'total_bookings' => Booking::count(),
            'total_revenue' => Booking::paid()->sum('total_price'),
            'active_trains' => Train::where('status', 'active')->count(),
            'total_stations' => Station::count(),
            'pending_tickets' => Booking::unpaid()->count(),
            'paid_tickets' => Booking::paid()->where('is_used', 0)->count(),
            'completed_tickets' => Booking::completed()->count(),
            'cancelled_tickets' => Booking::cancelled()->count(),
        ];

        // Recent bookings
        $recentBookings = Booking::with('user')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Today's revenue
        $todayRevenue = Booking::paid()
            ->whereDate('created_at', today())
            ->sum('total_price');

        // Popular routes
        $popularRoutes = Booking::select(
                'origin_station',
                'destination_station',
                DB::raw('COUNT(*) as total_bookings'),
                DB::raw('SUM(total_price) as total_revenue')
            )
            ->where('is_cancelled', 0)
            ->groupBy('origin_station', 'destination_station')
            ->orderByDesc('total_bookings')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentBookings', 'todayRevenue', 'popularRoutes'));
    }
}
