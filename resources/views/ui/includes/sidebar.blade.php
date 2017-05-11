<aside class="left-side sidebar-offcanvas">
<?php 
$selected_team = Session::get('selected_team', 0);

$team_name = $selected_team ? $selected_team['name'] : "";
//dd(@strstr($_SERVER['SERVER_NAME'],'projects')); 
?>
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="img/avatar3.png" class="img-circle" alt="User Image" />
			</div>
			<div class="pull-left info">
				<p>Hello, {{ $logged_in_username }}</p>
				<a href="#"><i class="fa fa-circle text-success"></i>Online</a>
			</div>
			<div class="pull-left info">
				<p><?php echo $team_name; ?></p>				
			</div>
		</div>
		<!-- search form -->
		<form action="#" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Search..."/>
				<span class="input-group-btn">
					<button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</form>
		<!-- /.search form -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li>
				<a href="/dashboard">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
			<?php $class_user = ''; if(Request::segment(1)=="users"){ $class_user = 'active'; } ?>
			<li class="<?php echo $class_user;?>">
				<a href="/users">
					<i class="fa fa-users"></i> <span>Users</span>
				</a>
			</li>
			<li class="<?php echo $class_user;?>">
				<a href="/teams">
					<i class="fa fa-users"></i> <span>Teams</span>
				</a>
			</li>
			<li>
				<a href="/categories">
					<i class="fa fa-dashboard"></i><span>Categories</span>
				</a>
			</li>
			<?php $class_project = ''; if(Request::segment(1)=="projects"){ $class_project = 'active'; } ?>
			<li class="<?php echo $class_project;?>">
				<a href="/projects">
					<i class="fa fa-dashboard"></i> <span>Projects</span>
				</a>
				
			</li>
				<?php $class_issu = ''; if(Request::segment(1)=="issues"){ $class_issu = 'active'; } ?>
				<li class="<?php echo $class_issu;?>"><a href="/issues"> <i class="fa fa-dashboard"></i> <span>Issues</span></a>
			</li>
            <li>
				<a>
					<i class="fa fa-dashboard"></i>
                    <span>User Management</span>
				</a>
                <ul>
                    <li><a href="/module">Module</a></li>
                    <li><a href="/actions">Actions</a></li>
                    <li><a href="/module_actions">Module Actions</a></li>
                </ul>
			</li>
			

			

		</ul>
	</section>
	<!-- /.sidebar -->
</aside>