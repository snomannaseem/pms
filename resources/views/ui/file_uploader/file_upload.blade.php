<form action="/file_upload" class="dropzone">
	<input type="hidden" name="id" value="<?php echo $data['id'];?>">
	<input type="hidden" name="type" value="<?php echo $data['type'];?>">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-2" class="modal fade">
  <div class="modal-dialog">
	  <div class="modal-content">
		  <div class="modal-header">
			  <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
			  <h4 class="modal-title">Choose any action</h4>
		  </div>
		  <div class="modal-body">
			  <form class="form-inline" role="form">
				  <div class="form-group">
					  <button id="download_this_attachment"  type="button" class="btn btn-default">Download</button>
				  </div>
					&nbsp;&nbsp;&nbsp;
				  <div class="form-group">
					<button  id="delete_this_attachment" type="button" class="btn btn-danger">Delete</button>
					</div>
					<input type="hidden" name="fileid_hidden" id="fileid_hidden" value="">
				</form>

		  </div>

	  </div>
  </div>
</div>
<script type="text/javascript">


</script>