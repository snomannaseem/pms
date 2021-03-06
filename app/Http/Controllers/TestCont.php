<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepo;
use Redirect;
use Cookie;
use Session;


class TestCont extends Controller
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
	
	public function teamLogin($id = 0){  //if id of the team is supplied login for that team
		//dd('teamLogin');
		$request = new \Illuminate\Http\Request();
		$error = "";
		$teams = new \App\Repositories\TeamRepo();
		$user = \Auth::user();
		$logged_in_user_id = $user ? $user->__get('id') : 0;
		$id = (int) $id;
		//dd($logged_in_user_id);
		//dd($user);
		
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
				
				//Cookie::queue(Cookie::make('selected_team', $myteam));
				Session::put('selected_team', $myteam);
				Session::forget('module_actions');
				//return $next($request);
				//dd($myteam);
				return Redirect::to('/projects');
				
			}
		}
		$myteams = $teams->getTeamsOfUser($logged_in_user_id);
		return view('ui.dashboard.index', ['name' => 'Atif', 'title' => 'Dashboard', 'myteams' => $myteams, 'error' => $error]);
    }

    public function index(Request $request){
		
		
		$this->user = new UserRepo();
		//dd($this->user->getUsersList());
		
        $paging['page_num'] = $request->input('page_num', 1);
        $paging['page_size'] = $request->input('page_size', env('DEFAULT_PAGE_SIZE'));
        $order_by['order'] = $request->input('order', 'asc');
        $order_by['sort_by'] = $request->input('sort_by', 'userid');
		
		$temp = $request->input('srch', "");
        parse_str($temp, $srch);
		$filters['name'] = isset($srch['table_search']) ? $srch['table_search'] : "";
		
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
		return view('ui.users.index', ['name' => 'users', 'title' => 'Fake Team', 'data_set' => $data_set]);
    }
	
	public function addedit($id, Request $request)
	{
		//Request $request
		$this->user = new UserRepo();
		$errors = "";
		$id = (int) $id;
		$data_set = $request_data = ['id' => $id, 'name' => $request->get('name',''), 
		'email' => $request->get('email',''), 'password' => $request->get('password','') ]; // default empty data set just to make		
		
		if($id != 0) // edit request, fetch the data to fill the form
		{
			$data_set 	= $this->user->getUserById($id);
		}
		if($request->isMethod('post'))
		{
			$validator = $this->user->getUserFormValidator($request_data);
			//dd($request_data);
			
			if($validator->fails() == false)
			{
				$name = $request->get('name');
				$email = $request->get('email');
				$password = $request->get('password');
				if($id == 0)
				{
					
					$user = new \App\Entities\Users();
					$user->setName($name);
					$user->setEmail($email);
					$user->setPassword($password);
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

}