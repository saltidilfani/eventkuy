<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Registration;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if (!auth()->user()->isAdmin()) {
            return redirect('/')->with('error', 'Akses ditolak. Anda bukan admin.');
        }

        return $next($request);
    }
}