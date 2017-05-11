<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepo;
use App\Repositories\RoleRepo;
use Redirect;
use Route;


class UserCont extends Controller
{
	
	public function __construct()
    {
        $this->logged_user = \Auth::user();
        
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
	
	

    public function index(Request $request){
		
		//$logged_in_userid = $this->logged_user->__get('id');
		$this->user = new UserRepo();
		$roles = new RoleRepo();
		//dd($this->user->getUsersList());
		
        $paging['page_num'] = $request->input('page_num', 1);
        $paging['page_size'] = $request->input('page_size', env('DEFAULT_PAGE_SIZE'));
        $order_by['order'] = $request->input('order', 'asc');
        $order_by['sort_by'] = $request->input('sort_by', 'userid');
		
		$temp = $request->input('srch', "");
        parse_str($temp, $srch);
		$filters['name'] = isset($srch['table_search']) ? $srch['table_search'] : "";
		//if($this->logged_user->__get('role_id') !== 1)
		//	$filters['logged_in_userid'] = $logged_in_userid;
		
		$data_set 	= $this->user->getUsersList($filters,$order_by, $paging);
		
			
		
		$data_set['sort_by'] 	= 'userid';
		$data_set['order'] 		= 'asc';
        if($request->ajax()){
            $view = view('ui.users.users_grid')->with(
                [
                    'sort_by'     	=> $order_by['sort_by'],
                    'order_by'     	=> $order_by['order'],
                    'data_set' => $data_set
                ]
            );

            $response = [
                'code'          => $data_set['code'],
                'sort_by'     	=> $order_by['sort_by'],
                'order_by'     	=> $order_by['order'],
                'page_size'     => $paging['page_size'], //$data_set['page_size'],
                'page_num'      => $paging['page_num'], //$data_set['page_num'],
                'total_rows'    => $data_set['total_rows'],
                'rows'          => $view->render()
            ];
			
            return response(json_encode($response))->header('Content-Type', 'json');
        }
		
		//return view('pages.users', ['name' => 'users', 'title' => 'User List']);
		return view('ui.users.index', ['name' => 'users', 'title' => 'User List', 'data_set' => $data_set]);
    }
	
	public function addedit($id, Request $request)
	{
		//dd(Route::current()->getUri());
		$logged_in_userid = $this->logged_user->__get('id');
		//Request $request
		$roles = new RoleRepo();
		$all_roles 	= $roles->getRoles();
		$this->user = new UserRepo();
		$errors = "";
		$id = (int) $id;
		$data_set = $request_data = ['id' => $id, 'name' => $request->get('name',''), 
		'email' => $request->get('email',''), 'password' => $request->get('password',''), 'roleId' => $request->get('role_id','') ]; // default empty data set just to make		
		
		if($id != 0) // edit request, fetch the data to fill the form
		{
			$data_set 	= $this->user->getUserById($id);
		}
		$data_set['all_roles'] = $all_roles;
		if($request->isMethod('post'))
		{
			$validator = $this->user->getUserFormValidator($request_data);
			//dd($request_data);
			
			if($validator->fails() == false)
			{
				$name = $request->get('name');
				$email = $request->get('email');
				$role_id = $request->get('role_id');
				$password = $request->get('password');
				if($id == 0)
				{
					
					$user = new \App\Entities\Users();
					$user->setName($name);
					$user->setEmail($email);
					$user->setPassword($password);
					$user->setRememberToken("");
					$user->setCreatedBy($logged_in_userid);
					$user->setCreatedOn(new \DateTime());
					$user->setRoleId($role_id);
					$user->setStatus(1);
					$this->user->save($user);
					
					return Redirect::to('/users')->with('message', 'Successfully added.');
					
				}
				else
				{
					$res = $this->user->update(['id' => $id, 'name' => $name, 'email' => $email, 'password' => $password ]);
					return Redirect::to('/users')->with('message', 'Successfully edited.');
				}
			}
			else
			{
				$errors = implode("<br>", $validator->errors()->all());
				
			}
		}
		
		
		return view('ui.users.user_addedit', ['errors' => $errors, 'name' => 'users', 'title' => 'Add User', 'id' => $id, 'data_set' => $data_set]);
	}
	
	public function delete($id)
	{
		$this->user = new UserRepo();
		$errors = "";
		$id = (int) $id;
		$res = $this->user->delete($id);
		/*
		if($res['code'] == 200)
		{
			return Redirect::to('/users')->with('message', 'Successfully deleted.');
		}
		*/
		return $res;
		
	}
	
	public function search(Request $request)
	{
		$user = new UserRepo();
		return $user->search(['term' => $request['term'], 'status' => 1]);
		
	}
	
	public function add(Request $request)
	{
		return $this->addedit(0, $request);
	}
	
	public function edit($id, Request $request)
	{
		return $this->addedit($id, $request);
	}

}