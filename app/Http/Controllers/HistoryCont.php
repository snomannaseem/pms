<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\IssueRepo;
use App\Repositories\HistoryRepo;

use App\Validation\Validate;
#use Auth;
class HistoryCont extends Controller
{
    public function __construct()
    {
        #$this->logged_user = Auth::user();
        //$this->issue 	= new IssueRepo();
        $this->history	= new HistoryRepo();
    }
	public function getHistory(Request $request){
		$userid = 1;
		$post_data = $request->all();
		$post_data['userid'] = $userid;
		$history_data =  $this->history->getHistory($post_data);
		
		$view = view('ui.issue.history')->with(['history_data'=> $history_data]);
		$response = array(
                'code' 			=> 200,
                'status' 		=> 'ok',
                'rows' 			=> $view->render()
            );
		return response(json_encode($response))->header('Content-Type', 'json');
	}
	
	
}