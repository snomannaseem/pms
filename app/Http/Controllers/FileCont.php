<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProjectRepo;
use App\Repositories\FileRepo;
use App\Validation\Validate;
use Auth;
class FileCont extends Controller
{
    public function __construct()
    {
        $this->logged_user = \Auth::user();
		$this->file = new FileRepo();
    }
		
    public function upload(Request $request){
		$post_data = $request->all();
		$post_data['userid'] =	$this->logged_user->__get('id');
		return  $this->file->uploadFile($post_data);
	}
	public function getFiles(Request $request){
		$post_data = $request->all();
		return  $this->file->getFile($post_data);
	}	
	public function downloadFiles($id){
		return  $this->file->downloadFiles($id);
	}
	public function deleteFiles($id){
		$this->file->deleteFiles($id);
		return redirect()->back();
 	}
	
}