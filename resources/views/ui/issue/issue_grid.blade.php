<?php

	//dd($result_set);
	
	$rows = "";
	
	foreach($result_set['rows'] as $result_object){
	
		$user_name = '';
		$update_name = '';
		$row_issue_id 			= $result_object['issue_id'];
		$issue_title 			= ucfirst($result_object['issue_title']);
		$project_title 			= $result_object['project_tilte'];
		$cat 					= ucfirst($result_object['cat_name']);
		$resolution_name 		= ucfirst($result_object['resolution_name']);
		$issue_type_name 		= ucfirst($result_object['issue_type_name']);
		$pirority_name 			= ucfirst($result_object['pirority_name']);
		$status 				= $result_object['status'];
		
		
		$row_status= 0;
		$hide_st = "false";
		$status_label = $status_class = "";
		if($row_status == 0)
		{
			$status_label = "Deleted";
			$status_class = "label-danger";
			$hide_st = "true";
		}
		elseif($row_status == 1)
		{
			$status_label = "In Progress";
			$status_class = " label-info";
		}
		elseif($row_status == 2)
		{
			$status_label = "Completed";
			$status_class = " label-success";
			
		}
		
		$status_time_icon = "fa-play";
		if($status=="in progress"){
			$status_time_icon = "fa-pause";
		}
		if($status=="closed"){
			$status_time_icon = "fa-stop";
		}
		
		$rows .= "<tr>
					 <td id ='logid'>${row_issue_id}</td>
					 <td>${issue_title}</td>
					 <td>${project_title}</td>
					 <td>${cat}</td>
					 <td>${resolution_name}</td>
					 <td>${issue_type_name}</td>
					 <td>${pirority_name}</td>
					 <td>
						  <button id=\"btn_edit\" rid=\"${row_issue_id}\" class=\"btn btn-default btn-xs btn_edit\"><i class=\"fa fa-pencil\"></i></button>
						  <button id=\"btn_del\"  rstatus =\"${hide_st}\" rid=\"${row_issue_id}\" class=\"btn btn-default btn-xs btn_view\"><i class=\"glyphicon glyphicon-eye-open\"></i></button>
					 </td>
					 <td>
						  <button id=\"btn_spent\" rid=\"${row_issue_id}\" class=\"btn btn-default btn-xs btn_timespent\"><i  rid=\"${row_issue_id}\" class=\"fa ${status_time_icon}\"></i></button>
					</td>
				  </tr>";
	}
?>
@include('ui.common.grid',['header' => $header , 'paging_result_set' => $result_set, 'rows' => $rows])