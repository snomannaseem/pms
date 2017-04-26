<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProjectRepo;
use App\Repositories\IssueRepo;
use App\Repositories\CommentRepo;
use App\Validation\Validate;
use Auth;
class IssueCont extends Controller
{
    public function __construct()
    {
        $this->logged_user = \Auth::user();
        $this->pro 		= new ProjectRepo();
        $this->issue 	= new IssueRepo();
    }
		
    public function index(Request $request){
		
		
		$temp = $request->input('srch', "");
        parse_str($temp, $srch);
		$filters['name'] = isset($srch['table_search']) ? $srch['table_search'] : "";
		
		$filters['userid'] = $this->logged_user->__get('id');

		$paging['page_num']  = $request->input('page_num', 1);
		$paging['page_size'] = $request->input('page_size', env('DEFAULT_PAGE_SIZE'));
		$order_by['order']   = $request->input('order', 'desc');
		$order_by['sort_by'] = $request->input('sort_by', 'pirority_name');
		$result_set = $this->issue->getIssueList($filters, $order_by, $paging);
		
		
		
		$result_set['sort_by' ] = $order_by['sort_by'];
        $result_set['order'] = $order_by['order'];
		$header = [
            "issue_id" 					=> "Id",
            "issue_title" 				=> "Title",
            "project_title" 			=> "Project",
			"cat_name" 					=> "Category",
            "resolution_name"			=> "Resolution",
			"issue_type_name" 			=> "Issue Type",
			"priority_name" 			=> "Pirority",
			"action"					=>	"Action"
        ];
		
		 if ($request->ajax()) {
            $view = view('ui.issue.issue_grid')->with(
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
		
		return view('ui.issue.index', array(
            "header" 		=> $header,
            "result_set" 	=> $result_set,
            'sort_by'     	=> $order_by['sort_by'],
            'order_by'     	=> $order_by['order'],
			'name'			=> 'Issue',
			));
	 }
	public function add(Request $request){
		$userid =  $this->logged_user->__get('id');
		$projects 			= $this->pro->getProjectByUserId($userid);
		$cats 				= $this->pro->getCategories();
		$priorities 		= $this->pro->getPriorities();
		$issue_rso_types 	= $this->pro->getIssueResolutionType();
		$issue_types 		= $this->pro->getIssueType();
		
		return view('ui.issue.add',['name'=>'Suresh','projects'=>$projects,'cats'=>$cats,'priorities'=>$priorities,'issue_rso_types'=>$issue_rso_types,'issue_types'=>$issue_types]);
	}
	public function edit($id){
		$userid =  $this->logged_user->__get('id');
		$issue_data = $this->issue->getIssueById($id);
		$projects 			= $this->pro->getProjectByUserId($userid);
		$cats 				= $this->pro->getCategories();
		$priorities 		= $this->pro->getPriorities();
		$issue_rso_types 	= $this->pro->getIssueResolutionType();
		$issue_types 		= $this->pro->getIssueType();
		return view('ui.issue.add',['data'=>$issue_data[0],'name'=>'Suresh','projects'=>$projects,'cats'=>$cats,'priorities'=>$priorities,'issue_rso_types'=>$issue_rso_types,'issue_types'=>$issue_types]);
	}
	
	public function create(Request $request){
		
		$post_data = $request->all();
		$post_data['userid'] =   $this->logged_user->__get('id');
		$validate_array = array( 'issue_title' => 'required','estimate_time'=>'required|numeric','assigned_to'=>'required');
		$validation_res = Validate::validateMe($post_data, $validate_array);

        if ($validation_res['code'] == 401) { return $validation_res; }
		return $this->issue->createIssue($post_data);
	}
	public function delete($id){
		return $this->pro->delete($id);
	}
	public function getProjectAssignee(Request $request){
		$post_data = $request->all();
		return $this->pro->getAssginee($post_data['project_id']);
	}
	public function getParentIssueLists(Request $request){
		$post_data = $request->all();
		return $this->issue->getParentIssueLists($post_data['project_id']);
	}
	public function view($id){
		$userid =  $this->logged_user->__get('id');
		
		$issue_data = $this->issue->getIssueById($id);
		$this->com 	= new CommentRepo();
		$commens_data = $this->com->getCommentById($id);
		$user_array = array('userid'=>$userid,'username'=>$this->logged_user->__get('name'),'userimage'=>($this->logged_user->__get('profile_image')!=null)?$this->logged_user->__get('profile_image'):"default.jpg");
		return view('ui.issue.view',['data'=>$issue_data[0],'comments_data' =>$commens_data,'userdata'=>$user_array ]);
	}
	/*Get subtask list*/
	public function getSubTask(Request $request){
		$post_data = $request->all();
		$substask_data =  $this->issue->getSubTaskListByTaskId($post_data);
	//	print_r($substask_data);
		$view = view('ui.issue.subtask')->with(['substask_data'=> $substask_data,'parent_issue_id'=>$post_data['issue_id']]);
		$response = array(
                'code' 			=> 200,
                'status' 		=> 'ok',
                'rows' 			=> $view->render()
            );
		return response(json_encode($response))->header('Content-Type', 'json');
	}
}