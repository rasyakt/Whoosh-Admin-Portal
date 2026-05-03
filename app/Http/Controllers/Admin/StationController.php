<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Station;
use App\Models\StationDuration;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $stations = Station::when($search, function ($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('code', 'LIKE', "%{$search}%");
        })->orderBy('name')->get();

        return view('admin.stations.index', compact('stations', 'search'));
    }

    public function create()
    {
        return view('admin.stations.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'code' => 'required|max:10',
            'location' => 'nullable|max:200',
            'facilities' => 'nullable|max:500',
        ]);

        Station::create($request->only('name', 'code', 'location', 'facilities'));

        return redirect()->route('admin.stations.index')
            ->with('success', 'Station created successfully.');
    }

    public function edit(Station $station)
    {
        return view('admin.stations.form', compact('station'));
    }

    public function update(Request $request, Station $station)
    {
        $request->validate([
            'name' => 'required|max:100',
            'code' => 'required|max:10',
            'location' => 'nullable|max:200',
            'facilities' => 'nullable|max:500',
        ]);

        $station->update($request->only('name', 'code', 'location', 'facilities'));

        return redirect()->route('admin.stations.index')
            ->with('success', 'Station updated successfully.');
    }

    public function destroy(Station $station)
    {
        $station->delete();
        return redirect()->route('admin.stations.index')
            ->with('success', 'Station deleted successfully.');
    }
}
