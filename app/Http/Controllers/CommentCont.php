<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\IssueRepo;
use App\Repositories\CommentRepo;
use App\Validation\Validate;
#use Auth;
class CommentCont extends Controller
{
    public function __construct()
    {
        #$this->logged_user = Auth::user();
        //$this->issue 	= new IssueRepo();
        $this->comment 	= new CommentRepo();
    }
	public function addComment(Request $request){
		$userid = 1;
		$post_data = $request->all();
		$post_data['userid'] = $userid;
		return $this->comment->addComment($post_data);
	}
	public function getComments(Request $request){
		$this->issue 	= new IssueRepo();
		$post_data = $request->all();
		$userid = 1;
		$commens_data = $this->comment->getCommentById($post_data['issue_id']);
		$issue_data = $this->issue->getIssueById($post_data['issue_id']);
		$user_array = array('userid'=>$userid,'username'=>'Noman','userimage'=>(isset($this->logged_user)?$this->logged_user->getImage():"default.jpg"));
		
		$view = view('ui.issue.comments')->with(['comments_data'=> $commens_data,'userdata'=>$user_array,'data'=>$issue_data[0]]);
		$response = array(
                'code' 			=> 200,
                'status' 		=> 'ok',
                'rows' 			=> $view->render()
            );
		return response(json_encode($response))->header('Content-Type', 'json');
	}
	public function deleteComment(Request $request){
		$userid = 1;
		$post_data = $request->all();
		$post_data['userid'] = $userid;
		return $this->comment->deleteComment($post_data);
	}
	
	
}