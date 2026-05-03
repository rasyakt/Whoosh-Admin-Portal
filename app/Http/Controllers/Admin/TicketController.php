<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');

        $bookings = Booking::with(['user', 'passengers'])
            ->when($search, function ($q) use ($search) {
                $q->where('booking_code', 'LIKE', "%{$search}%")
                  ->orWhere('origin_station', 'LIKE', "%{$search}%")
                  ->orWhere('destination_station', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', fn($q) => $q->where('name', 'LIKE', "%{$search}%"));
            })
            ->when($status, function ($q) use ($status) {
                match ($status) {
                    'booked' => $q->unpaid(),
                    'paid' => $q->paid()->where('is_used', 0),
                    'completed' => $q->completed(),
                    'cancelled' => $q->cancelled(),
                    default => null,
                };
            })
            ->when($dateFrom, fn($q) => $q->where('created_at', '>=', $dateFrom))
            ->when($dateTo, fn($q) => $q->where('created_at', '<=', $dateTo . ' 23:59:59'))
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.tickets.index', compact('bookings', 'search', 'status', 'dateFrom', 'dateTo'));
    }

    public function show(Booking $ticket)
    {
        $ticket->load(['user', 'passengers']);
        return view('admin.tickets.show', compact('ticket'));
    }

    public function updateStatus(Request $request, Booking $ticket)
    {
        $request->validate([
            'action' => 'required|in:pay,complete,cancel,reactivate',
        ]);

        $action = $request->action;

        switch ($action) {
            case 'pay':
                $ticket->update(['is_paid' => 1, 'is_cancelled' => 0]);
                $message = 'Ticket marked as Paid.';
                break;
            case 'complete':
                $ticket->update(['is_used' => 1]);
                $message = 'Ticket marked as Completed.';
                break;
            case 'cancel':
                $ticket->update(['is_cancelled' => 1]);
                $message = 'Ticket has been Cancelled.';
                break;
            case 'reactivate':
                $ticket->update(['is_cancelled' => 0, 'is_used' => 0]);
                $message = 'Ticket has been Reactivated.';
                break;
        }

        return back()->with('success', $message);
    }
}
