<?php

	
	
	$rows = "";
	if (!isset($header) || count($header) == 0){
		$header = ['Team ID', 'Name','Resources','Status','Action'];
	}

	foreach($data_set['rows'] as $result_object){
	//    if($result_object->getUpdateInterface() == 2){
	//        $interface = 'UI';
	//    }

		$user_name = '';
		$update_name = '';
		$row_userid = $result_object['id'];
		$row_name = $result_object['name'];
		$row_resources = $result_object['total_memeber'];
		$row_status = $result_object['status'];
		//$row_email = $result_object->getEmail();
		$status_label = $status_class = "";
		if($row_status == 0)
		{
			$status_label = "Deleted";
			$status_class = "label-danger";
		}
		if($row_status == 'active')
		{
			$status_label = "Active";
			$status_class = "label-success";
		}
		if($row_status == 2)
		{
			$status_label = "Inactive";
		}
		$rows .= "<tr>
					 <td id ='logid'>${row_userid}</td>
					 <td>${row_name}</td>
					  <td>${row_resources}</td>
					 
					 <td><span class=\"label $status_class\">$status_label</span></td>
					 <td>
						  <button id=\"btn_edit\" rid=\"${row_userid}\" class=\"btn btn-default btn-xs btn_edit\"><i class=\"fa fa-pencil\"></i></button>
						  <button id=\"btn_del\"  rid=\"${row_userid}\" class=\"btn btn-default btn-xs btn_del\"><i class=\"fa fa-times\"></i></button>
						  <button id=\"btn_login\"  rid=\"${row_userid}\" class=\"btn btn-default btn-xs btn_login\"><i class=\"fa fa-sign-in\"></i></button>
					 </td>
				  </tr>";
	}
?>
@include('ui.common.grid',['header' => $header , 'paging_result_set' => $data_set, 'rows' => $rows])