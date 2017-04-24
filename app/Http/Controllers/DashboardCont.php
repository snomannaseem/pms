<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepo;
use Redirect;


class DashboardCont extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function __invoke($id){
        //return view('pages.users', ['name' => 'users']);
    }
	
	

    public function index(Request $request){
		
		return view('ui.dashboard.index', ['name' => 'Atif', 'title' => 'Dashboard']);
    }
	
	

}