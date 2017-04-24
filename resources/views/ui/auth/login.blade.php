<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PMS|</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="Developed By M Abdur Rokib Promy">
    <meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
	
    <!-- bootstrap 3.0.2 -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="/css/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- fullCalendar -->
    <!-- <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" /> -->
    <!-- Daterange picker -->
    <link href="/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="/css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <!-- <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" /> -->
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!-- Theme style -->
    <link href="/css/style.css" rel="stylesheet" type="text/css" />
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
          <![endif]-->
</head>
      <body class="skin-black">
                <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.html" class="logo">
                PMS
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">

                    </nav>
                </header>				<div class="wrapper row-offcanvas row-offcanvas-left">
                    <!-- Left side column. contains the logo and sidebar -->
                    
					<aside class="left-side sidebar-offcanvas">
	<section class="sidebar">
		
		<ul class="sidebar-menu">
			<li>
				<a href="index.html">
					<i class="fa fa-dashboard"></i> <span>Register</span>
				</a>
			</li>
			

		</ul>
	</section>
	<?php 
	
		$error_list = isset($error_list) ? $error_list : "" ; 
		$error_list = implode("<br>", explode("|", $error_list));
		$id = "";
		$post_data = isset($post_data) ? $post_data :  ['name' => '', 'email' => '', 'password' => '', 'id' => ''];
	?>
	<!-- /.sidebar -->
</aside>					<aside class="right-side">
				
                <!-- Main content -->
					                <section class="content">
				
					<p id="message" style="display:none" class="alert alert-success" >
										</p>
				
                    <div id="main" class="row">
					
                        <div class="col-xs-12">
								<section class="panel">
								<header class="panel-heading">Login</header>
								@if(Session::has('message'))
						
						
						{{ Session::get('message') }}
						
					@endif
					
					@if($errors->any())
					<?php $error_list .= $errors->first(); ?>
					@endif
								
								<div class="panel-body">
									<?php if($error_list != "") { ?><p class="alert alert-block alert-danger"><?php echo $error_list;  ?></p><?php } ?>
									<form role="form" action="" method="post">
									
									<p> Email: <input class="form-control" name="email" value="<?php echo $post_data['email'];?>" type="text"> </p>
									<p> Password: <input class="form-control" name="password" value="<?php echo $post_data['password'];?>" type="password"> </p>
									
									<p> <input class="btn btn-info" type='submit' value='submit' /> </p>
									<input type="hidden" value="{{ csrf_token() }}" name="_token" id="_token">
									</form>
								</div>
							</section>
                        </div>
                    </div>
                </section>
                <!-- /.content -->
                
					<div class="footer-main">
                    Copyright &copy Centricsource, 2017
                </div>
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
		<script type="text/javascript">
	var grid_list_page_name = 'users';
	var grid_edit_page_name = 'users';
</script>
<script src="js/pages/grid.js" type="text/javascript">
</script>
<script src="js/pages/pagingv2.js" type="text/javascript">
</script>

<script type="text/javascript">
       $(document).ready(function(){
              if(!paging_bg){
				  
                var paging_bg = new AdpadPaging(
                        {
                            "debug" : true,
                            "forms" : [{'type': 'search', 'id': 'camp_search'}, {'type': 'settings', 'id': 'this_page'}],
                            "url" : "/users",
                            "frm": "main",
                            "filter_by": "",
                            "search": "",
							"_token": "_token",
                            "per_page": 5,
                            "current_page": 1,
                            "total_pages" : 3,
                            "order": 'asc',
                            "sort_by": 'userid',
                            "this_grid" : "this_grid",
                            "before_send_callback": function(){
                                //console.log('before send callback');
                                //toggleSrcLock();
                                //  $('.msg_ok ,  .msg_error').hide();
                            },
                            "complete_callback" : function(){
                                //toggleSrcLock();
                            }
                        }
                );
            }

       
        });
 
</script>

</body>
</html>