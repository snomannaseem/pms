<?php
	$rows = "";
	if (!isset($header) || count($header) == 0){
		$header = ['Mod Act ID', 'Url', 'Description','',''];
	}

	foreach($data_set['resultSet']['object_array'] as $result_object){
		$user_name      = '';
		$update_name    = '';
		$row_modactid   = $result_object->getId();
		$row_moduleid   = $result_object->getId();
		$row_url        = $result_object->getUrl();
		$row_desc       = $result_object->getDescription();
        
		$rows .= "<tr>
					 <td id ='logid'>${row_modactid}</td>
					 <td>${row_url}</td>
					 <td>${row_desc}</td>
					 <td>
						  <button id=\"btn_edit\" rid=\"${row_modactid}\" class=\"btn btn-default btn-xs btn_edit\"><i class=\"fa fa-pencil\"></i></button>
						  <button id=\"btn_del\"  rid=\"${row_modactid}\" class=\"btn btn-default btn-xs btn_del\"><i class=\"fa fa-times\"></i></button>
					 </td>
				  </tr>";
	}
?>
@include('ui.common.grid',['header' => $header , 'paging_result_set' => $data_set, 'rows' => $rows])