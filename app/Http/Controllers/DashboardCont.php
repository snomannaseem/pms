<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepo;
use Redirect;


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
	
	

    public function index($id = 0){
		//$request = \App::request();
		$user = \Auth::user();
		$logged_in_user_id = $user->__get('id');
		$id = (int) $id;
		if($id == 0)
		{
			$myteams = $this->teams->getTeamsOfUser($logged_in_user_id);
		}
		return view('ui.dashboard.index', ['name' => 'Atif', 'title' => 'Dashboard']);
    }
	
	

}