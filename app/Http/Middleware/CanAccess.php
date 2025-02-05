<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CanAccess
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        // Log::info('Middleware CanAccess berjalan', [
        //     'user' => $user instanceof \App\Models\User ? $user->only(['id', 'email', 'role']) : null,
        //     'expected_role' => $role
        // ]);

        if (!$user || $user->role !== $role) {
            return redirect()->route($user->role . '.dashboard');
        }

        return $next($request);
    }
}
