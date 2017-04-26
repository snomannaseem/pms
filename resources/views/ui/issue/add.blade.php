@extends('ui.layouts.default')
@section('page_title', 'Add Issue')

@section('content')

<div class="row">
<?php 
$issue_readonly = '';
if(isset($_GET['type']) && $_GET['type']=="subtask"){
	$data = $_GET;
	$data['issue_type_id'] = 2;
	$issue_readonly ='disabled';
	$data['task_type'] = "subtask";
}

?>
					
	<div class="col-md-12">
		<section class="panel">
		
		  <header class="panel-heading">
			<?php echo isset($data['issue_id'])?"Edit Issue":"Add Issue";?>
		  </header>
		  <div class="panel-body">
			<div id="msg_add_issue" class="">
				
			</div>
			  <form class="form-horizontal tasi-form" method="get" id="add_issue">
				
				<div class="form-group"> 
				  
					  <label class="col-sm-2 col-sm-2 control-label">Category</label>
					  <div class="col-sm-3">
					   <select class="form-control" name="category" id="category" > 
								<?php if($cats['rows']) { foreach($cats['rows'] as $cat) {?>
									<option value ="<?php echo $cat->getId();?>"><?php  echo ucfirst($cat->getName());?></option>
								<?php } } ?>
						</select>
						</div>
				</div>
				
				<div class="form-group"> 
				  
					  <label class="col-sm-2 col-sm-2 control-label">Project</label>
					  <div class="col-sm-3">
					   <select class="form-control" name="project" id="project" > 
								<?php if($projects['rows']) { foreach($projects['rows'] as $pro) {?>
									<option value ="<?php echo $pro->getId();?>"><?php  echo $pro->getTitle();?></option>
								<?php } } ?>
						</select>
						</div>
				</div>
				<div class="form-group"> 
				  
					  <label class="col-sm-2 col-sm-2 control-label">Priorities</label>
					  <div class="col-sm-3">
					   <select class="form-control" name="priorities" id="priorities" > 
								<?php if($priorities['rows']) { foreach($priorities['rows'] as $priorities) {?>
									<option value ="<?php echo $priorities->getId();?>"><?php  echo ucfirst($priorities->getName());?></option>
								<?php } } ?>
						</select>
						</div>
				</div>
				
				<div class="form-group"> 
				  
					  <label class="col-sm-2 col-sm-2 control-label">Assigned To</label>
					  <div class="col-sm-3">
					   <select class="form-control" name="assigned_to" id="assigned_to" > 
								
						</select>
						</div>
				</div>
				
				<div class="form-group"> 
					  <label class="col-sm-2 col-sm-2 control-label">Issue Type</label>
					  <div class="col-sm-3">
					   <select  <?php echo $issue_readonly;?>   class="form-control" name="issue_type" id="issue_type" > 
								<?php if($issue_types) { foreach($issue_types as $issue_type) {
									
								?>
							<option  value ="<?php echo $issue_type['id'];?>"><?php  echo ucfirst($issue_type['name']);?></option>
								<?php } } ?>
						</select>
						</div>
				</div>
				
				
				<div class="form-group"> 
					  <label class="col-sm-2 col-sm-2 control-label">Resolution</label>
					  <div class="col-sm-3">
					   <select class="form-control" name="resolution" id="resolution" > 
								<?php if($issue_rso_types) { foreach($issue_rso_types as $issue_type) {?>
									<option value ="<?php echo $issue_type['id'];?>"><?php  echo ucfirst($issue_type['name']);?></option>
								<?php } } ?>
						</select>
						</div>
				</div>
				
				
			  
				  <div class="form-group">
					  <label class="col-sm-2 col-sm-2 control-label">Title</label>
					  <div class="col-sm-10">
						  <input id="issue_title" name="issue_title" type="text" class="form-control" value="<?php if(isset($data['issue_title'])){ echo $data['issue_title'];}?>">
					  </div>
				  </div>
				  <div class="form-group">
					  <label class="col-sm-2 col-sm-2 control-label">Description</label>
					  <div class="col-sm-10">
						<textarea class=" description form-control" id="description" name="description"><?php if(isset($data['description'])){ echo html_entity_decode($data['description']);}?></textarea>
					  </div>
				  </div>
				  <div class="form-group">
					  <label class="col-sm-2 col-sm-2 control-label">Estimate Time</label>
					  <div class="col-sm-3">
						  <input id="estimate_time" name="estimate_time" type="text" class="form-control round-input" value="<?php if(isset($data['est_time'])){ echo $data['est_time'];}?>">
					  </div>
				  </div>
				  
				  <div class="form-group"> 
				  
					  <label class="col-sm-2 col-sm-2 control-label">Status</label>
					  <div class="col-sm-3">
					   <select class="form-control" name="status" id="status" > 
								<option value="open">Open</option>
								<option value="in progress">In Progress</option>
								<option value="resolved">Resolved</option>
								<option value="reopened">Reopened</option>
								<option value="closed">Closed</option>
						</select>
						</div>
				</div>
				  <div class="form-group">
				  <label class="col-lg-2 col-sm-2 control-label"></label>
				  <div class="col-lg-10">
					<input type="hidden" name="id" id="id" value="<?php if(isset($data['issue_id'])) echo $data['issue_id'];?>">
					<input type="hidden" name="parent_issue_type" id="parent_issue_type" value="<?php if(isset($data['parent_issue_type'])) echo $data['parent_issue_type'];?>">
					<input type="hidden" name="task_type" id="task_type" value="<?php if(isset($data['task_type'])) echo $data['task_type'];?>">
					<button type="button" class="btn btn-info" id="create_issue"><?php echo isset($data['issue_id'])?"Update":"Submit";?></button>
				 </div>
				</div>
			  </form>
		  </div>
		</section>
	   </div>
</div>

<script src="/ckeditor/ckeditor.js" type="text/javascript"></script>

@stop
@section('client_script')
<script type="text/javascript">
 var cat_id = '<?php echo isset($data['cat_id'])?$data['cat_id']:'';?>';
 var project = '<?php echo isset($data['project_id'])?$data['project_id']:'';?>';
 var priorities = '<?php echo isset($data['priority_id'])?$data['priority_id']:'';?>';
 var assigned_to = '<?php echo isset($data['assigned_to'])?$data['assigned_to']:'';?>';
 var issue_type = '<?php echo isset($data['issue_type_id'])?$data['issue_type_id']:'';?>';
 var resolution = '<?php echo isset($data['resolution_id'])?$data['resolution_id']:'';?>';
 var status = '<?php echo isset($data['status'])?$data['status']:'';?>';
 var parent_issue_id 	= '<?php echo isset($data['parent_issue_id'])?$data['parent_issue_id']:'';?>';
 //category
	$(document).ready(function(){
	
	$('#category option[value="' + cat_id + '"]').prop('selected', true);
	$('#project option[value="' + project + '"]').prop('selected', true);
	$('#priorities option[value="' + priorities + '"]').prop('selected', true);
	$('#assigned_to option[value="' + assigned_to + '"]').prop('selected', true);
	$('#issue_type option[value="' + issue_type + '"]').prop('selected', true);
	$('#resolution option[value="' + resolution + '"]').prop('selected', true);
	$('#status option[value="' + status + '"]').prop('selected', true);
	
/*	if(parent_issue_id!=0){
		onChangeIssueDropDown();
		$('#parent_issue_div').show();
		//$('#parent_issue_type option[value="' + parent_issue_id + '"]').attr('selected', true);
	}
	*/	/*Onchange of Project Get Assigne Name */
		onChangeAssigneeDropDown();
		$("#project").change(function () {
			$('#parent_issue_div').hide();
			$('#issue_type').find('option:first').attr('selected', 'selected');
			$("#issue_type option:selected").removeAttr("selected");
			onChangeAssigneeDropDown();
		});
		
		/*On change of issue reneder sub issues*/
		/*$("#issue_type").change(function () {
			$('#parent_issue_div').hide();
			if($("#issue_type option:selected").text().toLowerCase() =="sub-task"){
				onChangeIssueDropDown();
			}
			
		});*/
		
		CKEDITOR.replace('description');
		
		/*Create */
		  $('#create_issue').click(function(){
			for (instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}	
			request_data = $('#add_issue').serializeArray();
			pageURI = '/issues/create';
			mainAjax('add_issue', request_data, 'POST',fillResponse);
		 });
		
		
	});
	function onChangeAssigneeDropDown(){
		var project_id = $('#project').val();
		if(project_id){
			request_data = {'project_id':project_id}
			pageURI = '/getproject_assignee';
			mainAjax('add_project', request_data, 'POST',fillProjectAssignee);
		}
	
	}
	
	function onChangeIssueDropDown(){
		var project_id = $('#project').val();
		if(project_id){
			request_data = {'project_id':project_id}
			pageURI = '/get_parent_issue_list';
			mainAjax('add_project', request_data, 'POST',fillTaskIssue);
		}
	
	}
	function fillTaskIssue(data){
		console.log(data);
		if(data.code==200){
			$('#parent_issue_div').show();
			if(!$.isEmptyObject(data.rows)){
			$('#parent_issue_type').html('');
				$.each(data.rows, function (key, value) {
					console.log(key,value.issue_id)
					$('#parent_issue_type').append($("<option></option>").attr("value", value.issue_id).text(value.issue_title));
				});
				}else{
					$('#parent_issue_type').html($("<option></option>").attr("value", '').text('Issue not found'));
				}
		}
		if(parent_issue_id){
			$('#parent_issue_type option[value="' + parent_issue_id + '"]').attr('selected', true);
		}
		
	}
	function fillProjectAssignee(data){
		if(data.code==200){
			if(!$.isEmptyObject(data.data.rows)){
			$('#assigned_to').html('');
				$.each(data.data.rows, function (key, value) {
					console.log(key,value.id)
					$('#assigned_to').append($("<option></option>").attr("value", value.id).text(value.name));
				});
				}else{
					$('#assigned_to').html($("<option></option>").attr("value", '').text('Assginee not found'));
				}
		}
	}
	function fillResponse(data){
		console.log(data);
		if(data.code==200){
			 window.location = '/issues';
		}else{
		goToByScroll('msg_add_issue');
		}
	}
</script>
@stop