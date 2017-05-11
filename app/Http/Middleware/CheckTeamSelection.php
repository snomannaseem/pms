<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use View;
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
		//dd('ceckTeamSelection: in team');
		//dd(Session::get('module_actions', null));
		$route_path = \Route::getCurrentRoute()->getPath();
		$user = \Auth::user();
		//dd($user);
		$current_route = \Request::route()->getName();
		//dd($current_route);
		//dd($route_path);
		if($user === null)
		{
			//dd('in if');
			//dd($user);
			//dd($current_route);
			if($current_route != "login_get" && $current_route != "login_post") return redirect('/login');
			return $next($request);
		}
		
		$logged_in_userid = $user->__get('id');
		$util = new \App\Helpers\Util();
		$is_super_admin = Session::get('is_super_admin', null);  // null means value is not set yet in session. find out if it is super admin and set it in session.
		if($is_super_admin === null) $is_super_admin = $util->isSuperAdmin($logged_in_userid);
		Session::put('is_super_admin', $is_super_admin);
		
		//dd($logged_in_userid);
		//dd($role_id);
		//$selected_team = $request->session()->get('selected_team');
		//$selected_team = $request->cookie('selected_team');
		//$selected_team = $request->cookie('selected_team');
		$selected_team = Session::get('selected_team');
		//dd($selected_team);
		if($is_super_admin === false && $selected_team == null)
		{
			//print ":".\Request::route()->getName();
			//dd('ceckTeamSelection: null');
			//dd($current_route);
			if(($current_route != "dashboard" && $current_route != "root" && $current_route != "login_get" && $current_route != "login_post" && $current_route != "teamlogin"))
			{
				
				return redirect('/dashboard'); //->intended('dashboard');
			}
		}
		elseif($current_route != "teamlogin")
		{
		
		
		/******* START: PERMISSION CHECKING SEGMENT (DONOT DELETE/MOVE IT) *******/
		
		// IF superadmin then write code to bypass permission and team selection altogether
		//return $next($request);
		//$role_id = $user->__get('role_id');
		$selected_team = Session::get('selected_team', 0);
		
		$role_id = $selected_team ? $selected_team['role_id'] : 0;
		//dd($selected_team);
		//\View::share('selected_team',$selected_team);
		
		$module_actions = Session::get('module_actions', null);  // null means value is not set yet in session. find out all allowed actions for his roles(only valid in the context of teams and user != 'superadmin') and set it in session.
		//dd($is_super_admin);
		if($module_actions === null) $module_actions = $util->getModuleActions($role_id);
		Session::put('module_actions', $module_actions);
		//dd($module_actions);
		if($is_super_admin == false && $util->havePermission($module_actions, $route_path) == false)  //dashboard must be allowed to everybody
		{
			return response()->view('ui.common.no_permission');
		}
		
		/******* END: PERMISSION CHECKING SEGMENT (DONOT DELETE/MOVE IT) *******/
		
		}
		
		//$request->merge([ 'selected_team' => $selected_team ]);
        return $next($request);
    }
}
