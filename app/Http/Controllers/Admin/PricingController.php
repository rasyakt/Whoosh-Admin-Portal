<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingRule;
use App\Models\Station;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $classFilter = $request->get('class');

        $rules = PricingRule::when($search, function ($q) use ($search) {
                $q->where('origin_station', 'LIKE', "%{$search}%")
                  ->orWhere('destination_station', 'LIKE', "%{$search}%");
            })
            ->when($classFilter, fn($q) => $q->where('coach_class', $classFilter))
            ->orderBy('origin_station')
            ->orderBy('destination_station')
            ->get();

        $stations = Station::orderBy('name')->get();
        return view('admin.pricing.index', compact('rules', 'search', 'classFilter', 'stations'));
    }

    public function create()
    {
        $stations = Station::orderBy('name')->get();
        return view('admin.pricing.form', compact('stations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'origin_station' => 'required|max:100',
            'destination_station' => 'required|max:100',
            'coach_class' => 'required|in:Ekonomi,Bisnis,First Class',
            'base_price' => 'required|integer|min:0',
            'peak_price' => 'required|integer|min:0',
            'off_peak_price' => 'required|integer|min:0',
            'effective_from' => 'nullable',
            'effective_until' => 'nullable',
        ]);

        PricingRule::create(array_merge($request->only(
            'origin_station', 'destination_station', 'coach_class',
            'base_price', 'peak_price', 'off_peak_price',
            'effective_from', 'effective_until'
        ), ['is_active' => 1]));

        return redirect()->route('admin.pricing.index')
            ->with('success', 'Pricing rule created successfully.');
    }

    public function edit(PricingRule $pricing)
    {
        $stations = Station::orderBy('name')->get();
        return view('admin.pricing.form', compact('pricing', 'stations'));
    }

    public function update(Request $request, PricingRule $pricing)
    {
        $request->validate([
            'origin_station' => 'required|max:100',
            'destination_station' => 'required|max:100',
            'coach_class' => 'required|in:Ekonomi,Bisnis,First Class',
            'base_price' => 'required|integer|min:0',
            'peak_price' => 'required|integer|min:0',
            'off_peak_price' => 'required|integer|min:0',
            'effective_from' => 'nullable',
            'effective_until' => 'nullable',
        ]);

        $pricing->update($request->only(
            'origin_station', 'destination_station', 'coach_class',
            'base_price', 'peak_price', 'off_peak_price',
            'effective_from', 'effective_until'
        ));

        return redirect()->route('admin.pricing.index')
            ->with('success', 'Pricing rule updated successfully.');
    }

    public function destroy(PricingRule $pricing)
    {
        $pricing->delete();
        return redirect()->route('admin.pricing.index')
            ->with('success', 'Pricing rule deleted successfully.');
    }
}
