<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MobileUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $users = MobileUser::on('sqlsrv')
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            })
            ->withCount('bookings')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.users.index', compact('users', 'search'));
    }

    public function show(int $id)
    {
        $user = MobileUser::on('sqlsrv')
            ->withCount('bookings')
            ->findOrFail($id);

        $bookings = $user->bookings()
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        return view('admin.users.show', compact('user', 'bookings'));
    }
}
