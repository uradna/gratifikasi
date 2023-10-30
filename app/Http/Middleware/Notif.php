<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Closure;

class Notif
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
        $updatedata=DB::select('select count(id) as n from dataupdate where status = \'0\' ;');
        session(['updatedata' => $updatedata[0]->n]);

        $createuser=DB::select('select count(id) as n from createusers where status = \'0\' ;');
        session(['createuser' => $createuser[0]->n]);

        $deleteuser=DB::select('select count(id) as n from deleteusers where status = \'0\' ;');
        session(['deleteuser' => $deleteuser[0]->n]);

        $notif=$updatedata[0]->n + $createuser[0]->n + $deleteuser[0]->n;
        session(['notif' => $notif]);
        
        return $next($request);
    }
}
