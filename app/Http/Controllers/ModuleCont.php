<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ModuleRepo;
use App\Validation\Validate;
use Redirect;


class ModuleCont extends Controller
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
        $this->mod = new ModuleRepo();
    }
    
    public function index(Request $request){
		$this->mod = new ModuleRepo();
		
        $paging['page_num'] = $request->input('page_num', 1);
        $paging['page_size'] = $request->input('page_size', env('DEFAULT_PAGE_SIZE'));
        $order_by['order'] = $request->input('order', 'asc');
        $order_by['sort_by'] = $request->input('sort_by', 'userid');
		
		$temp = $request->input('srch', "");
        parse_str($temp, $srch);
		$filters['name'] = isset($srch['table_search']) ? $srch['table_search'] : "";
		
		$data_set 	= $this->mod->getModuleList($filters,$order_by, $paging);
        
		$data_set['sort_by'] 	= 'userid';
		$data_set['order'] 		= 'asc';
        
        if($request->ajax()){
            $view = view('ui.modules.modules_grid')->with(
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
            'ui.modules.index', 
            [
                'name' => 'users', 
                'title' => 'Module List', 
                'data_set' => $data_set
            ]
        );
    }
	
    public function addModule(Request $request){		
		return view('ui.modules.add');
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
		
		return $this->mod->createModule($post_data);
	}
    
    public function editModule($id){
        //dd($id);
		$module_data = $this->mod->getModuleById($id);
		return view('ui.modules.add',['data'=>$module_data]);
	}
    
	
	public function deleteModule($id){
		return $this->mod->delete($id);
	}

}