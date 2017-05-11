<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ModuleActionsRepo;
use App\Validation\Validate;
use Redirect;


class ModuleActionsCont extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function __construct()
    {
        $this->logged_user = \Auth::user();
        $this->mact = new ModuleActionsRepo();
    }
    
    public function index(Request $request){
		$this->mact = new ModuleActionsRepo();
		
        $paging['page_num'] = $request->input('page_num', 1);
        $paging['page_size'] = $request->input('page_size', env('DEFAULT_PAGE_SIZE'));
        $order_by['order'] = $request->input('order', 'asc');
        $order_by['sort_by'] = $request->input('sort_by', 'userid');
		
		$temp = $request->input('srch', "");
        parse_str($temp, $srch);
		$filters['name'] = isset($srch['table_search']) ? $srch['table_search'] : "";
		
		$data_set 	= $this->mact->getModuleActionsList($filters,$order_by, $paging);
        
		$data_set['sort_by'] 	= 'userid';
		$data_set['order'] 		= 'asc';
        
        if($request->ajax()){
            $view = view('ui.module_actions.modules_actions_grid.blade')->with(
                [
                    'sort_by'     	=> $order_by['sort_by'],
                    'order_by'     	=> $order_by['order'],
                    'data_set'      => $data_set
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
		return view(
            'ui.module_actions.index', 
            [
                'name' => 'users', 
                'title' => 'Module Action List', 
                'data_set' => $data_set
            ]
        );
    }
	
    public function addModuleActions(Request $request){		
		return view('ui.module_actions.add');
	}
    
    public function create(Request $request){
		//dd($request);
		$post_data = $request->all();
		$post_data['userid'] = $this->logged_user->__get('id');
		$validate_array = array( 'name' => 'required');
		
        $validation_res = Validate::validateMe($post_data, $validate_array);

        if ($validation_res['code'] == 401) {
            return $validation_res;
        }
		
		return $this->mact->createModuleAction($post_data);
	}
    
    public function editModuleActions($id){
        //dd($id);
		$action_data = $this->act->getModuleActionById($id);
		return view('ui.module_actions.add',['data'=>$action_data]);
	}
    
	public function deleteModuleActions($id){
		return $this->act->delete($id);
	}

}