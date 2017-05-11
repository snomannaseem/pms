@extends('ui.layouts.default')
@section('content')

<script>

</script>

<div class="row">
	<div class="col-lg-6">
		<section class="panel">
			<header class="panel-heading">Add Team</header>
			<div class="panel-body">
				<?php if($errors != "") { ?><p class="alert alert-block alert-danger"><?php echo $errors;  ?></p><?php } ?>
				<form role="form" !action="/teams/<?php echo $id; ?>" method="post">
				<div class="form-group"> Name: <input class="form-control" id="name" name="name" value="<?php echo $data_set['name'];?>" type="text"> </div>
				<p> Add User By Typing and Enter: <input class="form-control" id="userid" name="userid" value="" type="text" autocomplete="off" class="ui-autocomplete-input" > </p>
				
				<div class="panel">
                                <header class="panel-heading">
                                    Teammates
                                </header>

                                <ul class="list-group teammates">
									<?php 
									
									foreach($team_res as $user)
									{
										if($user['deletedBy'] != null) continue;
										$profile_image = $user['profile_image']!=null?"/user_images/".$user['profile_image']:"/user_images/default.jpg";
										
										$roles_select_html = "&nbsp;<select name='roleids[]'>";
										foreach($role_res as $role)
										{
											$roles_select_html .= "<option value='{$role['id']}' ".($role['id'] == $user['roleId'] ? "selected='selected'" : "").">{$role['role']}</option>"; 
										}
										$roles_select_html .= "</select>";
										
									?>
									<li class="alert list-group-item"><button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button><a href=""><img width="50" height="50" src="<?php echo $profile_image;?>"></a><a href=""><?php echo $user['name']; ?></a><input type="hidden" name="userids[]" value="<?php echo $user['id']; ?>" /><?php echo $roles_select_html; ?></li>
									<?php 
									} 
									?>
                                    <!-- li class="list-group-item">
                                        <a href=""><img width="50" height="50" src="img/26115.jpg"></a>
                                        <span class="pull-right label label-danger inline m-t-15">Admin</span>
                                        <a href="">Damon Parker</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href=""><img width="50" height="50" src="img/26115.jpg"></a>
                                        <span class="pull-right label label-info inline m-t-15">Member</span>
                                        <a href="">Joe Waston</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href=""><img width="50" height="50" src="img/26115.jpg"></a>
                                        <span class="pull-right label label-warning inline m-t-15">Editor</span>
                                        <a href="">Jannie Dvis</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href=""><img width="50" height="50" src="img/26115.jpg"></a>
                                        <span class="pull-right label label-warning inline m-t-15">Editor</span>
                                        <a href="">Emma Welson</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href=""><img width="50" height="50" src="img/26115.jpg"></a>
                                        <span class="pull-right label label-success inline m-t-15">Subscriber</span>
                                        <a href="">Emma Welson</a>
                                    </li -->
                                </ul>
                                <!-- div class="panel-footer bg-white">
                                    <span class="pull-right badge badge-info">32</span>
                                    <button class="btn btn-primary btn-addon btn-sm">
                                        <i class="fa fa-plus"></i>
                                        Add Teammate
                                    </button>
                                </div -->
                            </div>
				
				
				<p> <input class="btn btn-info" type='submit' value='Submit' /> 
				 <input id="cancel_btn" class="btn " type='button' value='Cancel' /> </p>
				<input type="hidden" value="{{ csrf_token() }}" name="_token" id="_token">
				</form>
			</div>
		</section>
	</div>
</div>
	<?php
	$roles_select_html = "<select name='roleids[]'>";
	foreach($role_res as $role)
	{
		$roles_select_html .= "<option value='{$role['id']}'>{$role['role']}</option>"; 
	}
	$roles_select_html .= "</select>";
	?>
@stop
@section('client_script')
<script type="text/javascript">
	   roles = <?php echo $role_res ? json_encode($role_res) : 0; ?>;
	   roles_select_html = "&nbsp;<?php echo $roles_select_html; ?>";
		
       $(document).ready(function(){
	   $(document).on("click", "#cancel_btn", function(){
			if(confirm('Are you sure to exit without saving current changes?')){
				window.location = '/teams';
			}
		});
              
			$( function() {
        $( "#userid" ).autocomplete({
		minLength: 0,
		source: function( request, response ) {
			$.ajax( {
			  url: "/users/search",
			 
			  data: {
				term: request.term
			  },
			  success: function( data ) {
				response( data );
			  }
			} );
      },
      focus: function( event, ui ) {
        $( "#project" ).val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
	  /*
        $( "#project" ).val( ui.item.label );
        $( "#project-id" ).val( ui.item.value );
        $( "#project-description" ).html( ui.item.desc );
        $( "#project-icon" ).attr( "src", "images/" + ui.item.icon );
		*/
		
		var profile_image = "/user_images/default.jpg";
		if(ui.item.profileImage!=null){
		var profile_image = "/user_images/"+ui.item.profileImage;
		}
		$(this).val('');
		$('.teammates').append('<li class="alert list-group-item"><button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button><a href=""><img width="50" height="50" src="'+profile_image+'"></a><a href="">'+ui.item.name+'</a><input type="hidden" name="userids[]" value="'+ui.item.id+'" />'+roles_select_html+'</li>');
		console.log('selected from autocomplete');
        return false;
      }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<div>" + item.name + "<br>" + item.email + "</div>" )
        .appendTo( ul );
    };
});

//cancel_btn
       
        });
 
</script>
@stop
