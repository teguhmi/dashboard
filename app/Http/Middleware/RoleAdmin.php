<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class RoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->hakakses == 'admin') {
            return $next($request);
        } else {
            $a = 'Semangaaaat....!!! ';
            $b = 'Akun anda belum diberikan akses untuk menu ini...';
            return redirect('home')->with(['warning' => $a . $b]);
        }
    }
}
