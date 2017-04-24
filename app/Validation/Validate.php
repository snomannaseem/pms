<?php
namespace App\Validation;

class Validate{

    public static  function validateMe($post_data,$validate_array = null){
        $messages = [
            'title.required'     		=> "Project tilte is  required.",
			'username.required'  		=> trans('messages.username_required'),
			'estimate_time.required' 	=> "Estimated time is required.",
			'issue_title.required'     	=> "Issue tilte is  required.",
			'assigned_to.required'     	=> "Assignee name is required",
			
        ];

        $validator = \Validator::make($post_data, $validate_array, $messages);

        if ($validator->fails()) {
            //$err = "<ul>";
            $err = "";
            foreach ($validator->getMessageBag()->toArray() as $error) {
                foreach ($error as $msg) {
                    $err .= "$msg|";
                }
            }
            //$err .= "";
            return array(
                'code' => 401,
                'status' => 'error',
                'msg' => $err
            );
        } else {
            return array(
                'code' => 200,
                'status' => 'ok',
            );
        }
    }
}



?>