@extends('ui.layouts.default')
@section('content')

<script>

</script>

<div class="row">
	<div class="col-lg-6">
		<section class="panel">
			<header class="panel-heading">Add/Remove Resources</header>
			<div class="panel-body">
				<?php if($errors != "") { ?><p class="alert alert-block alert-danger"><?php echo $errors;  ?></p><?php } ?>
				<form role="form" action="/projects/resources/<?php echo $id; ?>/add" method="post">
				
				<p> Add User By Typing and Enter: <input class="form-control" id="userid" name="userid" value="" type="text" autocomplete="off" class="ui-autocomplete-input" > </p>
				
				<div class="panel">
                                <header class="panel-heading">
                                    Teammates
                                </header>

                                <ul class="list-group teammates">
									<?php 
									foreach($resources_res as $user)
									{
									?>
									<li class="alert list-group-item"><button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button><a href=""><img width="50" height="50" src="img/26115.jpg"></a><a href=""><?php echo $user['name']; ?></a><input type="hidden" name="userids[]" value="<?php echo $user['id']; ?>" /></li>
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
		$('.teammates').append('<li class="alert list-group-item"><button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button><a href=""><img width="50" height="50" src="img/26115.jpg"></a><a href="">'+ui.item.name+'</a><input type="hidden" name="userids[]" value="'+ui.item.id+'" /></li>');
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
       
        });
 
</script>
@stop