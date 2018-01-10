<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

	protected $routes = [
            'api/v1/login/member',
    ];
    
	public function handle($request, Closure $next)
	{
		if ($this->isReading($request) 
           || $this->excludedRoutes($request) 
           || $this->tokensMatch($request))
       {
           return $this->addCookieToResponse($request, $next($request));
       }

       // throw new \TokenMismatchException;
	   return redirect()->back()->withError('Sorry, we could not verify your request. Please try again.');
		// return parent::handle($request, $next);
	}

	protected function excludedRoutes($request)
    {
        foreach($this->routes as $route)
            if ($request->is($route))
                return true;

            return false;
    }
}
