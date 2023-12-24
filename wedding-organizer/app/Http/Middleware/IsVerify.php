<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->is_verify==0) {
            auth()->logout();
            return redirect()->route('login')
                    ->with('message', 'Akun anda belum dikonfirmasi oleh admin!');
        }elseif (Auth::user()->is_verify==2) {
            auth()->logout();
            return redirect()->route('login')
                    ->with('message', 'Registrasi akun anda telah ditolak oleh admin!');
        }
        return $next($request);
    }
}
