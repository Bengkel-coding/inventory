<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Right {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */

	public function handle($request, Closure $next)
    {
    	$segment = \Request::segment(3);
        if(empty($segment))
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
