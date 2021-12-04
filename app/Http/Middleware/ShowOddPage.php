<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ShowOddPage
{
    
    public function handle(Request $request, Closure $next)
    {
        if (now()->format('s') % 2) {
            return $next($request);
        }

        return response('Not Allowed');
        // echo 'Not Allowed';
        // exit;
        // dd(now()->format('s'));
        // if (rand() % 2 == 1) {
        //     return $next($request);
        // }
        // dd(now(), rand() % 2);
    }
}