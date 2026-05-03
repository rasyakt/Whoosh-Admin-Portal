<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\MobileUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $todayRevenue = Booking::paid()->whereDate('created_at', today())->sum('total_price');
        $weeklyRevenue = Booking::paid()->where('created_at', '>=', Carbon::now()->startOfWeek())->sum('total_price');
        $monthlyRevenue = Booking::paid()->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->sum('total_price');
        $totalRevenue = Booking::paid()->sum('total_price');
        $totalBookings = Booking::count();
        $totalUsers = MobileUser::on('sqlsrv')->count();
        $activePaidTickets = Booking::paid()->where('is_used', 0)->count();

        $salesByDay = Booking::paid()
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->select(DB::raw("CONVERT(VARCHAR(10), created_at, 120) as date"), DB::raw('COUNT(*) as total_tickets'), DB::raw('SUM(total_price) as total_revenue'))
            ->groupBy(DB::raw("CONVERT(VARCHAR(10), created_at, 120)"))->orderBy('date')->get();

        $popularRoutes = Booking::where('is_cancelled', 0)
            ->select('origin_station', 'destination_station', DB::raw('COUNT(*) as total_bookings'), DB::raw('SUM(total_price) as total_revenue'))
            ->groupBy('origin_station', 'destination_station')->orderByDesc('total_bookings')->take(6)->get();

        $classDistribution = Booking::where('is_cancelled', 0)
            ->select('coach_class', DB::raw('COUNT(*) as total'))
            ->groupBy('coach_class')->get();

        $monthlyTrend = Booking::paid()
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->select(DB::raw("FORMAT(created_at, 'yyyy-MM') as month"), DB::raw('COUNT(*) as total_tickets'), DB::raw('SUM(total_price) as total_revenue'))
            ->groupBy(DB::raw("FORMAT(created_at, 'yyyy-MM')"))->orderBy('month')->get();

        return view('manager.dashboard', compact(
            'todayRevenue', 'weeklyRevenue', 'monthlyRevenue', 'totalRevenue',
            'totalBookings', 'totalUsers', 'activePaidTickets',
            'salesByDay', 'popularRoutes', 'classDistribution', 'monthlyTrend'
        ));
    }
}
