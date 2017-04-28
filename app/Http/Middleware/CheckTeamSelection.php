<?php

namespace App\Http\Middleware;

use Closure;

class CheckTeamSelection
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
		$selected_team = $request->session()->get('selected_team');
		if($selected_team == null)
		{
			return redirect()->intended('dashboard');
		}
        return $next($request);
    }
}
