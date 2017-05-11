@extends('ui.layouts.default')
@section('page_title', 'Add Module')

@section('content')

<div class="row">
    <?php 
        //dd($data);
    ?>
					
	<div class="col-md-12">
        <section class="panel">		
            <header class="panel-heading">
                <?php echo isset($data['id'])?"Edit Module":"Add Module";?>
            </header>
            
            <div class="panel-body">
                <div id="msg_add_module" class=""></div>
                
                <form class="form-horizontal tasi-form" method="get" id="add_module">
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input id="name" name="name" type="text" class="form-control" value="<?php if(isset($data['name'])){ echo $data['name'];}?>">
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label"></label>
                        <div class="col-lg-10">
                            <input type="hidden" name="id" id="id" value="<?php if(isset($data['id'])) echo $data['id'];?>">
                            <button type="button" class="btn btn-info" id="create_module"><?php echo isset($data['id'])?"Update":"Submit";?></button>
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
 //var status = '<?php echo isset($data['status'])?$data['status']:'';?>';
 
	$(document).ready(function(){
	
	
	//$('#status option[value="' + status + '"]').prop('selected', true);
		// CKEDITOR.replace('description');
		// $("#estimate_deadline" ).datepicker();
		
		/*Create */
		  $('#create_module').click(function(){
            // for (instance in CKEDITOR.instances) {
                // CKEDITOR.instances[instance].updateElement();
            // }	
            request_data = $('#add_module').serializeArray();
            pageURI = '/module/create';
            mainAjax('add_module', request_data, 'POST',fillResponse);
		 });
		
		
	});
	function fillResponse(data){
		console.log(data);
		if(data.code==200){
			 window.location = '/module';
		}else{
		goToByScroll('msg_add_module');
		}
	}
</script>
@stop