/*!
 * Made by: Syed Noman Naseem
 * 
 * 
 */
	$(document).ready(function (){
		
		$('#btn_add').click(function(){
			 window.location = grid_edit_page_name + '/0';
		});
		
		$(document).on("click", ".btn_edit", function(){
			 window.location = grid_edit_page_name + '/' + $(this).attr('rid');
		});

		
		$(document).on("click", ".btn_del", function(){
			if(confirm('Are you sure to delete this record?')){
				console.log('Record Deleted ' + $(this).attr('rid'));
				rid = $(this).attr('rid');
				$.get(grid_edit_page_name + '/delete/'+rid, {}, 
				function(data){
					$('#message').html("Successfully deleted");
					location = "/users";
				});
			}
		});
	});