<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Train;
use Illuminate\Http\Request;

class TrainController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $trains = Train::when($search, function ($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('train_code', 'LIKE', "%{$search}%");
        })->orderBy('name')->get();

        return view('admin.trains.index', compact('trains', 'search'));
    }

    public function create()
    {
        return view('admin.trains.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'train_code' => 'required|max:20',
            'capacity' => 'required|integer|min:1',
            'class_type' => 'required|max:30',
            'status' => 'required|in:active,maintenance,retired',
            'description' => 'nullable|max:500',
        ]);

        Train::create($request->only('name', 'train_code', 'capacity', 'class_type', 'status', 'description'));

        return redirect()->route('admin.trains.index')
            ->with('success', 'Train created successfully.');
    }

    public function edit(Train $train)
    {
        return view('admin.trains.form', compact('train'));
    }

    public function update(Request $request, Train $train)
    {
        $request->validate([
            'name' => 'required|max:100',
            'train_code' => 'required|max:20',
            'capacity' => 'required|integer|min:1',
            'class_type' => 'required|max:30',
            'status' => 'required|in:active,maintenance,retired',
            'description' => 'nullable|max:500',
        ]);

        $train->update($request->only('name', 'train_code', 'capacity', 'class_type', 'status', 'description'));

        return redirect()->route('admin.trains.index')
            ->with('success', 'Train updated successfully.');
    }

    public function destroy(Train $train)
    {
        $train->delete();
        return redirect()->route('admin.trains.index')
            ->with('success', 'Train deleted successfully.');
    }
}
