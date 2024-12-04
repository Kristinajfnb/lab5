<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user() && auth()->user()->hasRole('admin')) {
            return $next($request);
        }

        // В случае ошибки — редирект на страницу с ошибкой
        return redirect()->route('home')->with('error', 'У вас нет прав для доступа к этой странице.');
    }
}
