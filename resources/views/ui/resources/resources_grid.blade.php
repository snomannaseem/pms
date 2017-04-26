<?php

	
	
	$rows = "";
	if (!isset($header) || count($header) == 0){
		$header = ['Resource ID', 'Resource Name','',''];
	}

	foreach($data_set['resultSet']['object_array'] as $result_object){
	//    if($result_object->getUpdateInterface() == 2){
	//        $interface = 'UI';
	//    }

		$user_name = '';
		$update_name = '';
		$row_userid = $result_object->getId();
		//$row_name = $result_object->getName();
		$user = $result_object->getUser();
		//dd($result_object);
		$project = $result_object->getProject();
		
		
		
		$rows .= "<tr>
					 <td id ='logid'>${row_userid}</td>
					 <td>{$user->getName()}</td>
					 
					 
					 <td>
						  <!-- button id=\"btn_edit\" rid=\"${row_userid}\" class=\"btn btn-default btn-xs btn_edit\"><i class=\"fa fa-pencil\"></i></button -->
						  <button id=\"btn_del\"  rid=\"${row_userid}\" class=\"btn btn-default btn-xs btn_del\"><i class=\"fa fa-times\"></i></button>
					 </td>
				  </tr>";
	}
?>
@include('ui.common.grid',['header' => $header , 'paging_result_set' => $data_set, 'rows' => $rows])