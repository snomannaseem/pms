<!DOCTYPE html>
<html>
<head>
    @include('ui.includes.head')
	<?php
	$user = Auth::user();
	//$name = $user['name'];
	//dd($user);
	$logged_in_username = $user ? $user->__get('name') : "Unknown";
	?>
</head>
      <body class="skin-black">
                @include('ui.includes.header')
				<div class="wrapper row-offcanvas row-offcanvas-left">
                    <!-- Left side column. contains the logo and sidebar -->
                    
					@include('ui.includes.sidebar')
					<aside class="right-side">
				
                <!-- Main content -->
					@yield('content')
                <!-- /.content -->
                
					@include('ui.includes.footer')
            </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="/js/jquery.min.js" type="text/javascript"></script>
		<script src="/js/pages/global.js" type="text/javascript"></script>
		
		

        <!-- jQuery UI 1.10.3 -->
        
		<script src="/js/jquery-1.12.4.js"></script>
		<script src="/js/jquery-ui.js"></script>
		<link rel="stylesheet" href="/css/jquery-ui.css">
        <!-- Bootstrap -->
        <script src="/js/bootstrap.min.js" type="text/javascript"></script>

        <!-- Bootstrap WYSIHTML5
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>-->
		@yield('client_script')
</body>
</html>