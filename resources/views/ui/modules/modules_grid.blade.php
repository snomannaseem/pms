<?php
	$rows = "";
	if (!isset($header) || count($header) == 0){
		$header = ['Mod ID', 'Name','',''];
	}

	foreach($data_set['resultSet']['object_array'] as $result_object){
		$user_name      = '';
		$update_name    = '';
		$row_modid      = $result_object->getId();
		$row_name       = $result_object->getName();
        
		$rows .= "<tr>
					 <td id ='logid'>${row_modid}</td>
					 <td>${row_name}</td>
					 <td>
						  <button id=\"btn_edit\" rid=\"${row_modid}\" class=\"btn btn-default btn-xs btn_edit\"><i class=\"fa fa-pencil\"></i></button>
						  <button id=\"btn_del\"  rid=\"${row_modid}\" class=\"btn btn-default btn-xs btn_del\"><i class=\"fa fa-times\"></i></button>
					 </td>
				  </tr>";
	}
?>
@include('ui.common.grid',['header' => $header , 'paging_result_set' => $data_set, 'rows' => $rows])