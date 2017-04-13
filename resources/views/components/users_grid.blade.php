<?php

	
	
	$rows = "";
	if (!isset($header) || count($header) == 0){
		$header = ['User ID', 'Name','Email','Status','',''];
	}

	foreach($data_set['resultSet']['object_array'] as $result_object){
	//    if($result_object->getUpdateInterface() == 2){
	//        $interface = 'UI';
	//    }

		$user_name = '';
		$update_name = '';
		$row_userid = $result_object->getId();
		$row_name = $result_object->getName();
		$row_status = $result_object->getStatus();
		$row_email = $result_object->getEmail();
		$status_label = $status_class = "";
		if($row_status == 0)
		{
			$status_label = "Deleted";
			$status_class = "label-danger";
		}
		elseif($row_status == 1)
		{
			$status_label = "Active";
			$status_class = "label-success";
		}
		elseif($row_status == 2)
		{
			$status_label = "Inactive";
		}
		$rows .= "<tr>
					 <td id ='logid'>${row_userid}</td>
					 <td>${row_name}</td>
					 <td>${row_email}</td>
					 <td><span class=\"label $status_class\">$status_label</span></td>
					 <td>
						  <button id=\"btn_edit\" rid=\"${row_userid}\" class=\"btn btn-default btn-xs btn_edit\"><i class=\"fa fa-pencil\"></i></button>
						  <button id=\"btn_del\"  rid=\"${row_userid}\" class=\"btn btn-default btn-xs btn_del\"><i class=\"fa fa-times\"></i></button>
					 </td>
				  </tr>";
	}
?>
@include('components.grid',['header' => $header , 'paging_result_set' => $data_set, 'rows' => $rows])