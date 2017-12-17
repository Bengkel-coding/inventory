<?php

namespace App\Http\Middleware;

use Closure;

class Right
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
        if(empty(request()->segment(3)))
        {
            abort(404);
        }

        if(\trinata::right() == 'false')
        {
            return redirect(urlBackend('dashboard/index'))->with('infos','You not authorize');
        }

        return $next($request);
    }
}
