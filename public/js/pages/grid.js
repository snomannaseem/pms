/*!
 * Made by: Syed Noman Naseem
 * 
 * 
 */
	$(document).ready(function (){
		console.log('url is ', grid_list_page_name);
		$('#btn_add').click(function(){
			 window.location = grid_edit_page_name + '/add';
		});
		
		$(document).on("click", ".btn_edit", function(){
			 window.location = grid_edit_page_name + '/edit/' + $(this).attr('rid');
		});

		
		$(document).on("click", ".btn_del", function(){
			if(confirm('Are you sure to delete this record?')){
				console.log('Record Deleted ' + $(this).attr('rid'));
				rid = $(this).attr('rid');
				$.get(grid_edit_page_name + '/delete/'+rid, {}, 
				function(data){
					console.log('data url is ', grid_list_page_name);
					$('#message').show().html("Successfully deleted");
					location = "/"+grid_list_page_name;
				});
			}
		});
	});