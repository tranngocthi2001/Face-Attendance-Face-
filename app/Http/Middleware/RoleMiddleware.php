<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::guard('student')->user();

        if (!$user || $user->role != $role) {
            return redirect('/login')->withErrors(['access' => 'Bạn không có quyền truy cập.']);
        }

        return $next($request);
    }
}
