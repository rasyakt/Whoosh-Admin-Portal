<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session()->has('admin_user')) {
            $user = (object) session('admin_user');
            return redirect()->route($user->role === 'manager' ? 'manager.dashboard' : 'admin.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = AdminUser::where('email', $request->email)->where('is_active', 1)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials or account is inactive.'])->withInput();
        }

        session([
            'admin_user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'avatar' => $user->avatar,
            ]
        ]);

        ActivityLogger::log('User logged in successfully', $user, null, 'auth');

        return redirect()->route($user->role === 'manager' ? 'manager.dashboard' : 'admin.dashboard');
    }

    public function logout()
    {
        if (session()->has('admin_user')) {
            ActivityLogger::log('User logged out', null, null, 'auth');
        }
        session()->forget('admin_user');
        return redirect()->route('login');
    }
}
