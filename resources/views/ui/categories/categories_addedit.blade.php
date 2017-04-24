@extends('ui.layouts.default')
@section('content')
<?php
	$status_combo = ['Inactive', 'Active'];
?>

<div class="row">
	<div class="col-lg-6">
		<section class="panel">
			<header class="panel-heading">Add Category</header>
			<div class="panel-body">
				<?php if($errors != "") { ?><p class="alert alert-block alert-danger"><?php echo $errors;  ?></p><?php } ?>
				<form role="form" action="" method="post">
				<div class="form-group"> Name: <input class="form-control" name="name" value="<?php echo $data_set['name'];?>" type="text"> </div>
				
				<div class="form-group"> Status: <select class="form-control" name="status"  > 
				<?php 
					foreach($status_combo as $key => $value)
					{
						
						echo "<option ".($data_set['status'] == $key ? "selected='selected'" : '')." value='$key'>$value</option>";
						
					}
				?>
				</select></div>
				
				<p> <input class="btn btn-info" type='submit' value='submit' /> </p>
				<input type="hidden" value="{{ csrf_token() }}" name="_token" id="_token">
				</form>
			</div>
		</section>
	</div>
</div>
@stop
@section('client_script')
<script type="text/javascript">
		
		
       $(document).ready(function(){
              

       
        });
 
</script>
@stop