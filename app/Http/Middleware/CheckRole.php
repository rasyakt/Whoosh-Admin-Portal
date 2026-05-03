<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!$request->session()->has('admin_user')) {
            return redirect()->route('login');
        }

        $user = (object) $request->session()->get('admin_user');

        if (!empty($roles) && !in_array($user->role, $roles)) {
            abort(403, 'Unauthorized. You do not have access to this section.');
        }

        return $next($request);
    }
}
