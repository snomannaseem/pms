<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TeamRepo;
use Redirect;


class TeamCont extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function __invoke($id){
        //return view('pages.users', ['name' => 'users']);
		if(Session::get('is_super_admin', null) === null)
		{
			return response()->view('ui.common.no_permission');
		}
    }
	
	

    public function index(Request $request){
		
		
		$this->team = new TeamRepo();
		//dd($this->team->getUsersList());
		
        $paging['page_num'] = $request->input('page_num', 1);
        $paging['page_size'] = $request->input('page_size', env('DEFAULT_PAGE_SIZE'));
        $order_by['order'] = $request->input('order', 'asc');
        $order_by['sort_by'] = $request->input('sort_by', 'teamid');
		
		$temp = $request->input('srch', "");
        parse_str($temp, $srch);
		$filters['name'] = isset($srch['table_search']) ? $srch['table_search'] : "";
		
		$data_set 	= $this->team->getTeamsList($filters,$order_by, $paging);
			
		
		$data_set['sort_by'] 	= 'teamid';
		$data_set['order'] 		= 'asc';
        if($request->ajax()){
            $view = view('ui.teams.teams_grid')->with(
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
		
		//return view('pages.teams', ['name' => 'teams', 'title' => 'User List']);
		return view('ui.teams.index', ['name' => 'teams', 'title' => 'Team List', 'data_set' => $data_set]);
    }
	/*
	public function add($id, Request $request)
	{
		//Request $request
		//$user = Auth::user();
		dd('added');
		$logged_in_userid = 1; //$user->getUserid();
		$this->team = new TeamRepo();
		$errors = "";
		$id = (int) $id;
		$data_set = $request_data = ['id' => $id, 'name' => $request->get('name',''), 
		'email' => $request->get('email',''), 'password' => $request->get('password','') ]; // default empty data set just to make		
		
		if($id != 0) // edit request, fetch the data to fill the form
		{
			$data_set 	= $this->team->getUserById($id);
		}
		if($request->isMethod('post'))
		{
			$validator = $this->team->getTeamFormValidator($request_data);
			//dd($request_data);
			dd('submitted');
			if($validator->fails() == false)
			{
				$name = $request->get('name');
				//$email = $request->get('email');
				$userids = $request->get('userids');
				dd('submitted');
				if($id == 0)
				{
					
					$team = new \App\Entities\Team();
					$team->setName($name);
					//$team->setEmail($email);
					//$team->setPassword($password);
					$team->setCreatedBy($logged_in_userid);
					$team->setStatus('active');
					try {
						$res = $this->team->save($team);
						return Redirect::to('/teams')->with('message', 'Successfully added.');
					}
					catch(\Exception $e)
					{
						dd($e);
					}
					
				}
				else
				{
					try {
						$res = $this->team->update(['id' => $id, 'name' => $name, 'email' => $email, 'password' => $password ]);
						return Redirect::to('/teams')->with('message', 'Successfully edited.');
					}
					catch(\Exception $e)
					{
						dd($e);
					}
				}
			}
			else
			{
				$errors = implode("<br>", $validator->errors()->all());
				
			}
		}
		
		
		return view('ui.teams.team_addedit', ['errors' => $errors, 'name' => 'teams', 'title' => 'Add User', 'id' => $id, 'data_set' => $data_set]);
	}
	*/
	
	public function addedit($id, Request $request)
	{
		//Request $request
		$user = \Auth::user();
		
		$logged_in_userid = $user->__get('id');
		$this->team = new TeamRepo();
		$this->role = new \App\Repositories\RoleRepo();
		$errors = "";
		$id = (int) $id;
		$data_set = $request_data = ['id' => $id, 'name' => $request->get('name',''), 
		'email' => $request->get('email',''), 'password' => $request->get('password','') ]; // default empty data set just to make	
		$team_res = [];
		$role_res = $this->role->getRoles();
		
		if($id != 0) // edit request, fetch the data to fill the form
		{
			$data_set 	= $this->team->getTeamById($id);
			$team_res = $this->team->getTeamResourcesByTeamId($data_set['id']);
			//dd($data_set);
		}
		if($request->isMethod('post'))
		{
			$validator = $this->team->getTeamFormValidator($request_data);
			//dd($request_data);
			
			if($validator->fails() == false)
			{
				//dd($request->all());
				$name = $request->get('name');
				$userids = $request->get('userids');
				$roleids = $request->get('roleids');
				//$password = $request->get('password');
				//dd($id);
				if($id == 0)
				{
					//dd($logged_in_userid);
					$team = new \App\Entities\Teams();
					$team->setName($name);
					
					$team->setStatus('active');
					$team->setCreatedBy($logged_in_userid);
					$team->setCreatedOn(new \DateTime());
					try{
						$this->team->save($team);
						$this->team->saveTeamResources($team->getId(), $userids, $roleids, $logged_in_userid);
						return Redirect::to('/teams')->with('message', 'Successfully added.');
					}
					catch(\Exception $e)
					{
						dd($e);
					}
				}
				else
				{
					try {
						$res = $this->team->update(['id' => $id, 'name' => $name]);
						$res = $this->team->updateTeamResources($id, $userids, $roleids, $logged_in_userid);
						
						return Redirect::to('/teams')->with('message', 'Successfully edited.');
					}
					catch(\Exception $e)
					{
						dd($e);
					}
				}
			}
			else
			{
				$errors = implode("<br>", $validator->errors()->all());
				
			}
		}
		
		
		return view('ui.teams.team_addedit', ['errors' => $errors, 'name' => 'teams', 'title' => 'Add User', 'id' => $id, 'data_set' => $data_set, 'team_res' => $team_res, 'role_res' => $role_res]);
	}
	
	public function delete($id)
	{
		$user = \Auth::user();
		$logged_in_userid = $user->__get('id');
		$this->team = new TeamRepo();
		$errors = "";
		$id = (int) $id;
		try {
			$res = $this->team->delete($id, $logged_in_userid);
		}
		catch(\Exception $e)
		{
			dd($e);
			return [
				'code' => 1000, 'status' => 'cancel', 'msg', 'Error while deleting.'
			];
		}
		/*
		if($res['code'] == 200)
		{
			return Redirect::to('/teams')->with('message', 'Successfully deleted.');
		}
		*/
		return [
				'code' => 200, 'status' => 'ok', 'msg', 'Team succesfully delted.'
			];
		//return $res;
		
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