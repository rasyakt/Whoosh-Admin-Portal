<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Station;
use App\Models\Train;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $schedules = Schedule::with(['originStation', 'destinationStation', 'train'])
            ->when($search, function ($q) use ($search) {
                $q->where('train_code', 'LIKE', "%{$search}%")
                  ->orWhereHas('originStation', fn($q) => $q->where('name', 'LIKE', "%{$search}%"))
                  ->orWhereHas('destinationStation', fn($q) => $q->where('name', 'LIKE', "%{$search}%"));
            })
            ->orderBy('departure_time')
            ->get();

        return view('admin.schedules.index', compact('schedules', 'search'));
    }

    public function create()
    {
        $stations = Station::orderBy('name')->get();
        $trains = Train::where('status', 'active')->orderBy('name')->get();
        return view('admin.schedules.form', compact('stations', 'trains'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'train_id' => 'nullable|exists:sqlsrv.trains,id',
            'train_code' => 'required|max:20',
            'origin_station_id' => 'required|exists:sqlsrv.stations,id',
            'destination_station_id' => 'required|exists:sqlsrv.stations,id|different:origin_station_id',
            'departure_time' => 'required',
            'is_active' => 'boolean',
        ]);

        Schedule::create($request->only('train_id', 'train_code', 'origin_station_id', 'destination_station_id', 'departure_time', 'is_active'));

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Schedule created successfully.');
    }

    public function edit(Schedule $schedule)
    {
        $stations = Station::orderBy('name')->get();
        $trains = Train::where('status', 'active')->orderBy('name')->get();
        return view('admin.schedules.form', compact('schedule', 'stations', 'trains'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'train_id' => 'nullable|exists:sqlsrv.trains,id',
            'train_code' => 'required|max:20',
            'origin_station_id' => 'required|exists:sqlsrv.stations,id',
            'destination_station_id' => 'required|exists:sqlsrv.stations,id|different:origin_station_id',
            'departure_time' => 'required',
            'is_active' => 'boolean',
        ]);

        $schedule->update($request->only('train_id', 'train_code', 'origin_station_id', 'destination_station_id', 'departure_time', 'is_active'));

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Schedule updated successfully.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')
            ->with('success', 'Schedule deleted successfully.');
    }
}
