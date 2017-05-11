@extends('ui.layouts.default')
@section('content')

<?php

$all_roles = $data_set['all_roles'];
$role_id = $data_set['roleId'] ? $data_set['roleId'] : 1;
?>
<div class="row">
	<div class="col-lg-6">
		<section class="panel">
			<header class="panel-heading">Add User</header>
			
			<div class="panel-body">
				<?php if($errors != "") { ?><p class="alert alert-block alert-danger"><?php echo $errors;  ?></p><?php } ?>
				<form role="form" action="" method="post">
				<div class="form-group"> Name: <input class="form-control" name="name" value="<?php echo $data_set['name'];?>" type="text"> </div>
				<p> Email: <input class="form-control" name="email" value="<?php echo $data_set['email'];?>" type="text"> </p>
				<p> Password: <input class="form-control" name="password" value="<?php echo $data_set['password'];?>" type="password"> </p>
				<?php if($id == 0) { ?>
				<p> Confirm Password: <input class="form-control" name="password_confirm" type="password"> </p>
				<?php } ?>
				<p> Role: <select name='role_id'>
				<?php foreach($all_roles as $role) { ?>
					<option <?php echo $role['id'] == $role_id ? "selected='selected'" : ""; ?> value="<?php echo $role['id']; ?>"><?php echo $role['role']; ?></option>
				<?php } ?>
				</select> </p>
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