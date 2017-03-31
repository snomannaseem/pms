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
        //return view('pages.users', ['name' => 'users']);
    }

    public function index(){
		
		
		$this->user = new UserRepo();
		//dd($this->user->getUsersList());
		$data_set 	= $this->user->getUsersList();
		$data_set['sort_by'] 	= 'userid';
		$data_set['order'] 		= 'asc';
		
        return view('pages.users', ['name' => 'users', 'title' => 'User List', 'data_set' => $data_set]);
        //return view('pages.users', ['name' => 'users', 'title' => 'User List']);
		
		
    }

}