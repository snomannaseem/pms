<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function index(Request $request){
		
		
		$this->user = new UserRepo();
		//dd($this->user->getUsersList());
		
        $paging['page_num'] = $request->input('page_num', 1);
        $paging['page_size'] = $request->input('page_size', env('DEFAULT_PAGE_SIZE'));
        $order_by['order'] = $request->input('order', 'asc');
        $order_by['sort_by'] = $request->input('sort_by', 'userid');
		
		
		$data_set 	= $this->user->getUsersList([],$order_by, $paging);
		
			
		
		$data_set['sort_by'] 	= 'userid';
		$data_set['order'] 		= 'asc';
        if($request->ajax()){
            $view = view('common.user_grid')->with(
                [
                    'sort_by'     	=> $order_by['sort_by'],
                    'order_by'     	=> $order_by['order'],
                    'paging_result_set' => $data_set
                ]
            );

            $response = [
                'code'          => $data_set['code'],
                'sort_by'     	=> $order_by['sort_by'],
                'order_by'     	=> $order_by['order'],
                'page_size'     => $data_set['page_size'],
                'page_num'      => $data_set['page_num'],
                'total_rows'    => $data_set['total_rows'],
                'rows'          => $view->render()
            ];
			
            return response(json_encode($response))->header('Content-Type', 'json');
        }
		
		//return view('pages.users', ['name' => 'users', 'title' => 'User List']);
		return view('pages.users', ['name' => 'users', 'title' => 'User List', 'data_set' => $data_set]);
    }

}