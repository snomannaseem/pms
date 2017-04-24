<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CategoriesRepo;
use Redirect;


class CategoriesCont extends Controller
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
	
	

    public function index(Request $request){
		
		
		$this->cat = new CategoriesRepo();
		//dd($this->cat->getUsersList());
		
        $paging['page_num'] = $request->input('page_num', 1);
        $paging['page_size'] = $request->input('page_size', env('DEFAULT_PAGE_SIZE'));
        $order_by['order'] = $request->input('order', 'asc');
        $order_by['sort_by'] = $request->input('sort_by', 'userid');
		
		$temp = $request->input('srch', "");
        parse_str($temp, $srch);
		$filters['name'] = isset($srch['table_search']) ? $srch['table_search'] : "";
		
		$data_set 	= $this->cat->getCategoriesList($filters,$order_by, $paging);
		
			
		
		$data_set['sort_by'] 	= 'userid';
		$data_set['order'] 		= 'asc';
        if($request->ajax()){
            $view = view('ui.categories.categories_grid')->with(
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
		return view('ui.categories.index', ['name' => 'users', 'title' => 'Category List', 'data_set' => $data_set]);
    }
	
	public function addedit($id, Request $request)
	{
		//Request $request
		$this->cat = new CategoriesRepo();
		$errors = "";
		$id = (int) $id;
		$data_set = $request_data = [ 'id' => $id, 'name' => $request->get('name',''), 
		'status' => $request->get('status','') ]; // default empty data set just to make		
		
		if($id != 0) // edit request, fetch the data to fill the form
		{
			$data_set 	= $this->cat->getCategoryById($id);
		}
		if($request->isMethod('post'))
		{
			$validator = $this->cat->getUserFormValidator($request_data);
			//dd($request_data);
			
			if($validator->fails() == false)
			{
				$name = $request->get('name');
				$status = $request->get('status');
				
				if($id == 0)
				{
					
					$cat = new \App\Entities\Categories();
					$cat->setName($name);
					$cat->setStatus($status);
					$this->cat->save($cat);
					
					return Redirect::to('/categories')->with('message', 'Successfully added.');
					
				}
				else
				{
					$res = $this->cat->update(['id' => $id, 'name' => $name, 'status' => $status ]);
					return Redirect::to('/categories')->with('message', 'Successfully edited.');
				}
			}
			else
			{
				$errors = implode("<br>", $validator->errors()->all());
				
			}
		}
		
		
		return view('ui.categories.categories_addedit', ['errors' => $errors, 'name' => 'users', 'title' => 'Add Categories', 'id' => $id, 'data_set' => $data_set]);
	}
	
	public function delete($id)
	{
		$this->cat = new CategoriesRepo();
		$errors = "";
		$id = (int) $id;
		$res = $this->cat->delete($id);
		/*
		if($res['code'] == 200)
		{
			return Redirect::to('/users')->with('message', 'Successfully deleted.');
		}
		*/
		return $res;
		
	}

}