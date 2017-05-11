@extends('ui.layouts.default')
@section('page_title', 'Project')

@section('content')

<section class="content">
<div class="row">
<?php 
//dd($data);
?>
	<div class="col-sm-12">
		<section class="panel">
		
		  <header class="panel-heading"> Project Detail </header>
		  <div class="panel-body">
		  
			<form class="form-horizontal tasi-form" method="get" id="add_issue">
			
			<div class="col-sm-4">
				
				<div class="form-group">
					  <label class="control-label">Title</label> 
					  <div class="">
						<p class="form-control-static" ><?php if(isset($data['title'])){ echo $data['title'];}?></p>
					  </div>
				</div>
				
				</div>
				
				<div class="col-sm-4">
				
				<div class="form-group">
					  <label class="control-label">Estimation</label> 
					  <div class="">
						<p class="form-control-static"><?php echo ($data['estTime']);?> Hours</p>
					  </div>
				</div>
					
				</div>
				
				<div class="col-sm-4">
				
					<div class="form-group">
				  <label class="control-label">DeadLine</label> 
				  <div class="">
					<p class="form-control-static"><?php echo $data['estDeadline']->format('Y-m-d');;?></p>
				  </div>
				</div>
			 
				</div>
				
				<div class="col-lg-12">
				
				  <div class="form-group">
					  <label class="control-label">Description</label>
					  <div class="">
						<p class="form-control-static"> <?php if(isset($data['description'])){ echo html_entity_decode($data['description']);}?></p>
					  </div>
				  </div>
				
				  
				  <div class="form-group">
				  <label class="col-lg-2 control-label"></label>
				  <div class="col-lg-10"></div>	
				</div>
								
				</div>
				
			  </form>
		  </div>  
						
		</section>
		
	   </div>
	   
</div>

<div class="row">
	<div class="col-sm-12">
		<section class="panel general">
			<div class="panel-body">				
				<?php $data['type'] = 'project';?>
				@include('ui.file_uploader.file_upload',['data'=>$data])
			</div>
		</section>
	</div>
</div>

</section>

@stop
@section('client_script')
<script src="/js/dropzone.js"></script>
<link rel="stylesheet" href="/css/dropzone.css">
<script src="/js/file_upload.js"></script>


<script type="text/javascript">
var type_id = '<?php echo $data['id'];?>';
var extenion_data = new Array();
$(document).ready(function(){
	
	
	/*Multiple uploading*/
	
	request_data = {'type_id':type_id,type:'project'};
	pageURI = '/get_files';
	mainAjax('', request_data, 'POST',fillResponse);

	var md = new Dropzone(".dropzone", {});
	   md.on("complete", function (file) {
        if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
             location.reload();
        }

       // md.removeFile(file); # remove file from the zone.
    });
	function fillResponse(data){
	//console.log(md);
		console.log(data['rows']);
		 var html = "";
		 $.each(data['rows'], function(key,value) {
		 var name=value.filename.split('.').pop();
		 var image = "/img/"+name+".png";
		 var fileid= value.fileid.$oid;
		 console.log(fileid);
		 html+='<div fileid="'+fileid+'" class=" dz-preview dz-file-preview dz-processing dz-success dz-complete"> <div class="dz-image"><img  style=""data-dz-thumbnail="" alt="" src="'+image+'" class="'+name+'"></div><div class="dz-detailss">  <div class="dz-filename"><span data-dz-name="">'+value.filename+'</span></div>  </div>  <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div> <div class="dz-error-message"><span data-dz-errormessage=""></span></div> <div class="dz-success-mark"></div></div>';
	
			//console.log(key,value.filename);
			
			//console.log(name);
			//$(".dz-preview").find('.dz-image').addClass('ft_'+name);
			//md.element.classList.add('ft_'+name);
			
			var mockFile = { name: value.filename};
			//md.options.addedfile.call(md, mockFile);
			//md.options.thumbnail.call(md, mockFile, "uploads/"+value.name);
		 });
		 $('.dropzone').append(html);
		// md.previewTemplate = html;
	}
	
	$(document).on("click", ".dz-preview", function(){
		var fileid = $(this).attr('fileid');
		$('#fileid_hidden').val(fileid);
		 $('#myModal-2').modal('show');
		  
	});
	
	$(document).on("click", "#download_this_attachment", function(){
		$('#myModal-2').modal('hide');
		window.location = "/download_files/" +$('#fileid_hidden').val()
	});
	
	$(document).on("click", "#delete_this_attachment", function(){
		$('#myModal-2').modal('hide');
		window.location = "/delete_files/" +$('#fileid_hidden').val()
	});
	
	/*End of Multiple file*/
	
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		var target = $(e.target).attr("href");
		
	});
});


</script>

 
@stop