<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Setlocalmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        Session::put('lang','en');
//        dd(Session::get('local'));
        if (Session::has('local')){
//            dd('yes');
            app()->setLocale(session()->get('local'));
        }
        else{
//            dd(session()->get('local'));
            app()->setLocale('bn');
            session()->put('local','bn');
//            dd(session()->get('local'));
        }
        return $next($request);
    }
}
