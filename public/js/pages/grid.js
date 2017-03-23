/*!
 * Made by: Syed Noman Naseem
 * 
 * 
 */
	$(document).ready(function (){
		
		$('#btn_add').click(function(){
			 window.location = grid_edit_page_name + '/0';
		});
		
		$('#btn_edit').click(function(){
			 window.location = grid_edit_page_name + '/' + $(this).attr('rid');
		});

		$("#btn_del").click(function(){
			if(confirm('Are you sure to delete this record?')){
				console.log('Record Deleted ' + $(this).attr('rid'));
			}
		});
	});