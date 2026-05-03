<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $dateFrom = $request->get('date_from', now()->startOfMonth()->toDateString());
        $dateTo = $request->get('date_to', now()->toDateString());

        $bookings = Booking::with('user')
            ->where('is_cancelled', 0)
            ->whereBetween('created_at', [$dateFrom, $dateTo . ' 23:59:59'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $summary = Booking::where('is_cancelled', 0)
            ->whereBetween('created_at', [$dateFrom, $dateTo . ' 23:59:59'])
            ->select(
                DB::raw('COUNT(*) as total_bookings'),
                DB::raw('SUM(total_price) as total_revenue'),
                DB::raw('SUM(ticket_count) as total_passengers'),
                DB::raw('AVG(total_price) as avg_ticket_price')
            )->first();

        return view('manager.reports.sales', compact('bookings', 'summary', 'dateFrom', 'dateTo'));
    }

    public function passengers(Request $request)
    {
        $routeStats = Booking::where('is_cancelled', 0)
            ->select(
                'origin_station', 'destination_station', 'coach_class',
                DB::raw('SUM(ticket_count) as total_passengers'),
                DB::raw('COUNT(*) as total_bookings')
            )
            ->groupBy('origin_station', 'destination_station', 'coach_class')
            ->orderByDesc('total_passengers')
            ->get();

        $classSummary = Booking::where('is_cancelled', 0)
            ->select('coach_class', DB::raw('SUM(ticket_count) as total_passengers'), DB::raw('SUM(total_price) as total_revenue'))
            ->groupBy('coach_class')->get();

        return view('manager.reports.passengers', compact('routeStats', 'classSummary'));
    }
}
