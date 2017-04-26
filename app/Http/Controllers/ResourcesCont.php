<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ResourcesRepo;
use Redirect;


class ResourcesCont extends Controller
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
	
	

    public function index($id, Request $request){
		
		
		$this->resources = new ResourcesRepo();
		//dd($this->resources->getUsersList());
		$id = (int) $id;
        $paging['page_num'] = $request->input('page_num', 1);
        $paging['page_size'] = $request->input('page_size', env('DEFAULT_PAGE_SIZE'));
        $order_by['order'] = $request->input('order', 'asc');
        $order_by['sort_by'] = $request->input('sort_by', 'teamid');
		
		$temp = $request->input('srch', "");
        parse_str($temp, $srch);
		$filters['name'] = isset($srch['table_search']) ? $srch['table_search'] : "";
		$filters['project_id'] = $id;
		
		$data_set 	= $this->resources->getResourcesList($filters,$order_by, $paging);
		
			
		
		$data_set['sort_by'] 	= 'teamid';
		$data_set['order'] 		= 'asc';
        if($request->ajax()){
            $view = view('ui.resources.resources_grid')->with(
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
		
		return view('ui.resources.index', ['name' => 'Project Resources', 'title' => 'Project Resources', 'data_set' => $data_set]);
    }
	
	
	public function addedit($id, Request $request)
	{
		//Request $request
		$user = \Auth::user();
		
		$logged_in_userid = $user->__get('id');
		$this->resources = new ResourcesRepo();
		$errors = "";
		$id = (int) $id;
		$data_set = $request_data = ['id' => $id, 'name' => $request->get('name',''), 
		'email' => $request->get('email',''), 'password' => $request->get('password','') ]; // default empty data set just to make	
		$resources_res = [];
		
		if($id != 0) // edit request, fetch the data to fill the form
		{
			//$data_set 	= $this->resources->getProjectById($id);
			$resources_res = $this->resources->getResourcesByProjectId($id);//$data_set['id']);
			//dd($data_set);
		}
		if($request->isMethod('post'))
		{
			//$validator = $this->resources->getTeamFormValidator($request_data);
			//dd($request_data);
			
			//if($validator->fails() == false)
			//{
				//dd($request->all());
				$name = $request->get('name');
				$userids = $request->get('userids');
				//$password = $request->get('password');
				//dd($id);
				if($id == 0)
				{
					//dd($logged_in_userid);
					$resources = new \App\Entities\Teams();
					$resources->setName($name);
					
					$resources->setStatus('active');
					$resources->setCreatedBy($logged_in_userid);
					$resources->setCreatedOn(new \DateTime());
					try{
						$this->resources->save($resources);
						$this->resources->saveTeamResources($resources->getId(), $userids, $logged_in_userid);
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
						$res = $this->team->updateTeamResources($id, $userids, $logged_in_userid);
						
						return Redirect::to('/teams')->with('message', 'Successfully edited.');
					}
					catch(\Exception $e)
					{
						dd($e);
					}
				}
			//}
			/*
			else
			{
				$errors = implode("<br>", $validator->errors()->all());
				
			}
			*/
		}
		
		
		return view('ui.resources.resources_addedit', ['errors' => $errors, 'name' => 'resources', 'title' => 'Add User', 'id' => $id, 'data_set' => $data_set, 'resources_res' => $resources_res]);
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
	
	

}