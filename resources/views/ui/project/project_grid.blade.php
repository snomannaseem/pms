<?php

	//dd($result_set);
	
	$rows = "";
	
	foreach($result_set['object_array'] as $result_object){
	
		$user_name = '';
		$update_name = '';
		$row_proid 			= $result_object->getId();
		$row_name 			= $result_object->getTitle();
		$row_status 		= $result_object->getStatus();
		$row_est_date 		= $result_object->getEstDeadline()!=null?$result_object->getEstDeadline()->format('Y-m-d'):'';
		$row_created_date 	= $result_object->getCreatedOn()!=null?$result_object->getCreatedOn()->format('Y-m-d H:i:s'):'';
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
		$rows .= "<tr>
					 <td id ='logid'>${row_proid}</td>
					 <td>${row_name}</td>
					<td><span class=\"label $status_class\">$status_label</span></td>
					<td>${row_est_date}</td>
					<td>${row_created_date}</td>
					 <td>
						<button id=\"btn_edit_res\" rid=\"${row_proid}\" class=\"btn btn-default btn-xs btn_edit_res\"><i class=\"fa fa-pencil\"></i></button>	
						  <button id=\"btn_edit\" rid=\"${row_proid}\" class=\"btn btn-default btn-xs btn_edit\"><i class=\"fa fa-pencil\"></i></button>
						  <button id=\"btn_del\"  rstatus =\"${hide_st}\" rid=\"${row_proid}\" class=\"btn btn-default btn-xs btn_del\"><i class=\"fa fa-times\"></i></button>
					 </td>
				  </tr>";
	}
?>
@include('ui.common.grid',['header' => $header , 'paging_result_set' => $result_set, 'rows' => $rows])