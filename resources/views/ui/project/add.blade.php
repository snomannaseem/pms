@extends('ui.layouts.default')
@section('page_title', 'Add Project')

@section('content')

<div class="row">
<?php 
//dd($data);
?>
					
	<div class="col-md-12">
		<section class="panel">
		
		  <header class="panel-heading">
			<?php echo isset($data['id'])?"Edit Project":"Add Project";?>
		  </header>
		  <div class="panel-body">
			<div id="msg_add_project" class="">
				
			</div>
			  <form class="form-horizontal tasi-form" method="get" id="add_project">
				  <div class="form-group">
					  <label class="col-sm-2 col-sm-2 control-label">Title</label>
					  <div class="col-sm-10">
						  <input id="title" name="title" type="text" class="form-control" value="<?php if(isset($data['title'])){ echo $data['title'];}?>">
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
						  <input id="estimate_time" name="estimate_time" type="text" class="form-control round-input" value="<?php if(isset($data['estTime'])){ echo $data['estTime'];}?>"><small>Estimate time is in hours</small>
					  </div>
				  </div>
				  <div class="form-group">
					  <label class="col-sm-2 col-sm-2 control-label">Deadline</label>
					  <div class="col-sm-3">
						  <input id="estimate_deadline" name="estimate_deadline"class="form-control" id="focusedInput" type="text" value="<?php if(isset($data['estDeadline'])){ echo $data['estDeadline']->format('Y-m-d');}?>">
					  </div>
				  </div>
				  
				  <div class="form-group"> 
				  
					  <label class="col-sm-2 col-sm-2 control-label">Status</label>
					  <div class="col-sm-3">
					   <select class="form-control" name="status" id="status" > 
								<option value="1">In Progress</option>
								<option value="2">Completed</option>
								<option value="0">Deleted</option>
						</select>
						</div>
				</div>
				  <div class="form-group">
				  <label class="col-lg-2 col-sm-2 control-label"></label>
				  <div class="col-lg-10">
					<input type="hidden" name="id" id="id" value="<?php if(isset($data['id'])) echo $data['id'];?>">
					<button type="button" class="btn btn-info" id="create_project"><?php echo isset($data['id'])?"Update":"Submit";?></button>
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
 var status = '<?php echo isset($data['status'])?$data['status']:'';?>';
 
	$(document).ready(function(){
	
	
	$('#status option[value="' + status + '"]').prop('selected', true);
		CKEDITOR.replace('description');
		$("#estimate_deadline" ).datepicker();
		
		/*Create */
		  $('#create_project').click(function(){
				for (instance in CKEDITOR.instances) {
					CKEDITOR.instances[instance].updateElement();
				}	
			request_data = $('#add_project').serializeArray();
			pageURI = '/projects/create';
			mainAjax('add_project', request_data, 'POST',fillResponse);
		 });
		
		
	});
	function fillResponse(data){
		console.log(data);
		if(data.code==200){
			 window.location = '/projects';
		}else{
		goToByScroll('msg_add_project');
		}
	}
</script>
@stop