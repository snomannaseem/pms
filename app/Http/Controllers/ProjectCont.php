<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Request as REQ;
use App\Http\Controllers\Controller;
use App\Repositories\ProjectRepo;
use App\Validation\Validate;
use Auth;
use Session;

class ProjectCont extends Controller
{
    public function __construct()
    {
		$this->logged_user = \Auth::user();
        $this->pro = new ProjectRepo();
		// First check if it is not superadmin
		
		$is_super_admin = Session::get('is_super_admin', null);
		if($is_super_admin == false)
		{
			$id = REQ::route('id');  // The 'id' parameter must always be Project id
			$selected_team = Session::get('selected_team', 0);
			if($id !== null)  // only when Id is provided in url like projects/12, then we will check if this project is allowed to him(logged_in_user) (it is his team project)
			{
				$project = $this->pro->getProjectById($id);
				//dd($project, $selected_team);
				if($project['team']['id'] != $selected_team['id'])
				{
					// response()->view('ui.common.no_permission');
					return redirect('/404');
				}
			}
		}
		
        
    }
		
    public function index(Request $request){
			
		$temp = $request->input('srch', "");
        parse_str($temp, $srch);
		$filters['name'] = isset($srch['table_search']) ? $srch['table_search'] : "";
		
		$filters['userid'] =  $this->logged_user->__get('id');
		

		$paging['page_num']  = $request->input('page_num', 1);
		$paging['page_size'] = $request->input('page_size', env('DEFAULT_PAGE_SIZE'));
		$order_by['order']   = $request->input('order', 'desc');
		$order_by['sort_by'] = $request->input('sort_by', 'est_deadline');
		$result_set = $this->pro->getProjectsList($filters, $order_by, $paging);
		
		$result_set['sort_by' ] = $order_by['sort_by'];
        $result_set['order'] = $order_by['order'];
		$header = [
            "id" 			=> "Id",
            "title" 		=> "Title",
            "status" 		=> "Status",
			"estDeadline" 	=> "Deadline",
            "created_at" 	=> "Created At",
			"action" 		=> "Actions"
        ];
		
		 if ($request->ajax()) {
            $view = view('ui.project.project_grid')->with(
                [
                    'sort_by'     	=> $order_by['sort_by'],
                    'order_by'     	=> $order_by['order'],
                    'header' 		=> $header, 
					'result_set' 	=> $result_set]);
            $response = array(
                'code' 			=> 200,
                'status' 		=> 'ok',
                'sort_by'     	=> $order_by['sort_by'],
                'order_by'     	=> $order_by['order'],
                'page_size' 	=> $result_set['page_size'],
                'page_num' 		=> $result_set['page_num'],
                'total_rows' 	=> $result_set['total_rows'],
                'rows' 			=> $view->render()
            );
            return response(json_encode($response))->header('Content-Type', 'json');
        }
		
		return view('ui.project.index', array(
            "header" 		=> $header,
            "result_set" 	=> $result_set,
            'sort_by'     	=> $order_by['sort_by'],
            'order_by'     	=> $order_by['order'],
			'title'			=> 'Project List',
			'name'			=> 'Project',
			));
	 }
	public function add(Request $request){
		
		return view('ui.project.add');
	}
	public function edit($id){
		$project_data = $this->pro->getProjectById($id);
		return view('ui.project.add',['data'=>$project_data]);
	}
	
	public function create(Request $request){
		
		$post_data = $request->all();
		$post_data['userid'] = $this->logged_user->__get('id');
		$validate_array = array( 'title' => 'required','estimate_time'=>'required|numeric');
		
        $validation_res = Validate::validateMe($post_data, $validate_array);

        if ($validation_res['code'] == 401) {
            return $validation_res;
        }
		
		return $this->pro->createProject($post_data);
	}
	public function delete($id){
		return $this->pro->delete($id);
	}
	
	public function editresources($id) {
		$project_data = $this->pro->getProjectById($id);
		$project_resources = $this->pro->getProjectResources($id);
		return view('ui.project.add',['data'=>$project_data]);
	}
	public function view($id){
		$project_data = $this->pro->getProjectById($id);
		return view('ui.project.view',['data'=>$project_data]);
	}
	
}