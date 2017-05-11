$(document).ready(function(){

var md = new Dropzone(".dropzone", {});
	console.log(md);
	   md.on("complete", function (file) {
        if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
             location.reload();
        }

       // md.removeFile(file); # remove file from the zone.
    });
	function fillResponse(data){
	//console.log(md);
		//console.log(data['rows']);
		 var html = "";
		 $.each(data['rows'], function(key,value) {
		 var name=value.filename.split('.').pop();
		 var image = "/img/"+name+".png";
		 html+='<div  onclick="preview_data()" class=" dz-preview dz-file-preview dz-processing dz-success dz-complete"> <div class="dz-image"><img  style="width:100px;height:100px;"data-dz-thumbnail="" alt="" src="'+image+'" class="'+name+'"></div><div class="dz-detailss">  <div class="dz-filename"><span data-dz-name="">'+value.filename+'</span></div>  </div>  <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div> <div class="dz-error-message"><span data-dz-errormessage=""></span></div> <div class="dz-success-mark"></div></div>';
	
			//console.log(key,value.filename);
			
			//console.log(name);
			//$(".dz-preview").find('.dz-image').addClass('ft_'+name);
			//md.element.classList.add('ft_'+name);
			
			var mockFile = { name: value.filename};
			//md.options.addedfile.call(md, mockFile);
			//md.options.thumbnail.call(md, mockFile, "uploads/"+value.name);
		 });
		 $('.dropzone').append(html);
		// md.previewTemplate = html;
	}
	
	// Onclick 
	
	$(document).on("click", ".dz-preview", function(){
		alert("esy");
	});
	
});

function preview_data()(){
	alert("YRdy");
}