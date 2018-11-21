<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        if (auth()->check()) 
        {
            if (auth()->user()->IsAdmin()) 
            {
                return $next($request);
            }
            else
            {
                return redirect('home');
            }
        }
        else
        {
            return redirect('home');
        }
    }
}
