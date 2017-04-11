@extends('layouts.default')
@section('content')
        <form action="" method="post">
        <p> Name: <input name="name" type="text"> </p>
        <p> Email: <input name="email" type="text"> </p>
        <p> Password: <input name="password" type="password"> </p>
        <p> Confirm Password: <input name="password_confirm" type="password"> </p>
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