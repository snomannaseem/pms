@extends('layouts.default')
@section('content')

<p style="color:red"><?php echo $errors;  ?></p>

        <form action="" method="post">
        <p> Name: <input name="name" value="<?php echo $data_set['name'];?>" type="text"> </p>
        <p> Email: <input name="email" value="<?php echo $data_set['email'];?>" type="text"> </p>
        <p> Password: <input name="password" value="<?php echo $data_set['password'];?>" type="password"> </p>
		<?php if($id == 0) { ?>
        <p> Confirm Password: <input name="password_confirm" type="password"> </p>
		<?php } ?>
        <p> <input type='submit' value='submit' /> </p>
		<input type="hidden" value="{{ csrf_token() }}" name="_token" id="_token">
        </form>        
@stop
@section('client_script')
<script type="text/javascript">
		
		
       $(document).ready(function(){
              

       
        });
 
</script>
@stop