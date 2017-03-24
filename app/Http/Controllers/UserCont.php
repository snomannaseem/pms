<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepo;



class UserCont extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function __invoke($id){
        return view('pages.users', ['name' => 'users']);
    }

    public function index(){
		
		
		$this->user = new UserRepo();
		//dd($this->user->getUsersList());
		
        return view('pages.users', ['name' => 'users', 'title' => 'User List', 'data' => $this->user->getUsersList()]);
		
		
    }

}