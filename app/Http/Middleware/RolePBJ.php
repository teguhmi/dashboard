<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class RolePBJ
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
        if (Auth::check() && Auth::user()->hakakses == 'admin' ||
            Auth::user()->hakakses == 'regjian' ||
            Auth::user()->hakakses == 'bblba' ||
            Auth::user()->hakakses == 'direktur' ||
            Auth::user()->hakakses == 'kasubagtu') {
            return $next($request);
        } else
            $a = 'Semangaaaat....!!! ';
        $b = 'Akun anda belum diberikan akses untuk menu ini...';
        return redirect('/')->with(['warning' => $a . $b]);
    }
}
