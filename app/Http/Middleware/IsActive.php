<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Closure;

class IsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $c = DB::select('select * from setting limit 1');
        $t1=$c[0]->tgl_1;
        $t2=$c[0]->tgl_2;
        $now = date("Y-m-d");

        if ($t1 < $now && $t2 > $now) {
            return $next($request);
        } else {
            if (Auth::user() && Auth::user()->admin != 0) {
                return $next($request);
            }
        }
        $request->session()->flush();
        return redirect('login')->withError('expired');
    }
}
