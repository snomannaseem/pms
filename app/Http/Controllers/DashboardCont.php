<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepo;
use Redirect;
use App;


class DashboardCont extends Controller
{
	protected $request;
	public function __construct(Request $request) {
			$this->request = $request;
	}

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
	 
    public function __invoke($id){
        //return view('pages.users', ['name' => 'users']);
    }
	
	
	
    public function index($id = 0){  //if id of the team is supplied login for that team
		//echo('DashboardCont');
		$request = new \Illuminate\Http\Request();
		$error = "";
		$teams = new \App\Repositories\TeamRepo();
		$user = \Auth::user();
		$logged_in_user_id = $user ? $user->__get('id') : 0;
		$id = (int) $id;
		if($id != 0)
		{
			// Make sure that the logged in user is in the team provided in the url. before logging in to that team
			$myteams = $teams->getTeamsOfUser($logged_in_user_id);
			$myteam = [];
			$flag = false;
			foreach($myteams as $myteam)
			{
				if($myteam['id'] == $id)
				{
					$flag = true;
					break;
				}
			}
			if($flag == false)
			{
				$error = "You are not included in this team.";
			}
			else
			{
				//$myteam = $teams->getTeamById($id);
				$request->session()->put('selected_team', $myteam);
				return $next($request);
				
				
			}
		}
		$myteams = $teams->getTeamsOfUser($logged_in_user_id);
		$roles = $teams->getRolesInHashArray();
		
		return view('ui.dashboard.index', ['name' => 'Atif', 'title' => 'Dashboard', 'myteams' => $myteams, 'error' => $error, 'roles' => $roles]);
    }
	
	

}