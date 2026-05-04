<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MobileUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function create()
    {
        return view('admin.users.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:150|unique:sqlsrv.users,email',
            'phone' => 'nullable|max:20',
            'password' => 'required|min:6|confirmed',
        ]);

        MobileUser::on('sqlsrv')->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
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

    public function edit(int $id)
    {
        $user = MobileUser::on('sqlsrv')->findOrFail($id);
        return view('admin.users.form', compact('user'));
    }

    public function update(Request $request, int $id)
    {
        $user = MobileUser::on('sqlsrv')->findOrFail($id);

        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:150|unique:sqlsrv.users,email,' . $id,
            'phone' => 'nullable|max:20',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(int $id)
    {
        $user = MobileUser::on('sqlsrv')->findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
