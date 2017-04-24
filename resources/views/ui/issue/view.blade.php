@extends('ui.layouts.default')
@section('page_title', 'Issue')

@section('content')

<div class="row">
<?php 
//dd($data);
?>
					
	<div class="col-md-12">
		<section class="panel">
		
		  <header class="panel-heading"> Issue Detail </header>
		  <div class="panel-body">
		  
			<form class="form-horizontal tasi-form" method="get" id="add_issue">
				
				<div class="form-group">
					  <label class="col-sm-2 control-label">Title</label> 
					  <p class="" ><?php if(isset($data['issue_title'])){ echo $data['issue_title'];}?></p>
				</div>
				
				<div class="form-group">
					  <label class="col-sm-2 control-label">Reporter</label> 
					<p class="help-block"><?php echo ucfirst($data['create_by']);?></p>
				</div>
				
				
				
				  
				<div class="form-group"> 
					  <label class="col-sm-2 col-sm-2 control-label">Category</label>
					    <p class="" ><?php echo ucfirst($data['cat_name']);?></p>
				</div>
				
				<div class="form-group"> 
				  
					  <label class="col-sm-2 col-sm-2 control-label">Project</label>
					  <div class="col-sm-3"><?php echo ucfirst($data['project_tilte']);?></div>
				</div>
				<div class="form-group"> 
				  
					  <label class="col-sm-2 col-sm-2 control-label">Priorities</label>
					  <div class="col-sm-3"><?php echo ucfirst($data['pirority_name']);?></div>
				</div>
				<div class="form-group"> 
					  <label class="col-sm-2 col-sm-2 control-label">Issue Type</label>
					  <div class="col-sm-3"><?php echo ucfirst($data['issue_type_name']);?></div>
				</div>
				
				<div class="form-group"> 
					  <label class="col-sm-2 col-sm-2 control-label">Resolution</label>
					  	  <div class="col-sm-3"><?php echo ucfirst($data['resolution_name']);?></div>
				</div>
				
				  
				  <div class="form-group">
					  <label class="col-sm-2 col-sm-2 control-label">Description</label>
					  <div class="col-sm-10"> <?php if(isset($data['description'])){ echo html_entity_decode($data['description']);}?></div>
				  </div>
				  <div class="form-group">
					  <label class="col-sm-2 col-sm-2 control-label">Estimate Time</label>
					  <div class="col-sm-3"><?php if(isset($data['est_time'])){ echo $data['est_time'];}?></div>
				  </div>
				  
				  <div class="form-group">
				  <label class="col-lg-2 col-sm-2 control-label"></label>
				  <div class="col-lg-10">
					
				 </div>
				</div>
			  </form>
		  </div>
		  <section class="panel general">
                            <header class="panel-heading tab-bg-dark-navy-blue">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a data-toggle="tab" href="#comments">
                                            <i class="fa fa-home"> Comments</i>
                                        </a>
                                    </li>
                                    <li >
                                        <a data-toggle="tab" href="#history">
                                            <i class="fa fa-user"></i> History</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#attachments">
                                            <i class="fa fa-envelope-o"></i> Attachments</a>
                                    </li>
                                </ul>
                            </header>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div id="comments" class="tab-pane active">
                                        @include('ui.issue.comments',['comments_data' => $comments_data,'issue'=>$data,'userdata'=>$userdata])
                                    </div>
                                    <div id="history" class="tab-pane ">
									<div id="history_div" class="tab-pane active">
                                       
                                    </div>
									</div>
                                    <div id="attachments" class="tab-pane">Attachments</div>
                                </div>
                            </div>
                        </section>
						
		</section>
		
		
	   </div>
	   
</div>


@stop
@section('client_script')


<script type="text/javascript">
<?php $loged_user_image='/user_images/'.$userdata["userimage"];;

?>
var username	='<?php echo $userdata["username"];?>';
var userid		='<?php echo $userdata["userid"];?>';
var userimage	='<?php echo $userdata["userimage"];?>';

$(document).ready(function(){

var href = location.href;
var issue_id = href.match(/([^\/]*)\/*$/)[1];

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href");
    if(target =="#comments"){
		getComments(issue_id);
	}
	 if(target =="#history"){
		getHistory(issue_id);
	}
});


function getHistory(issue_id){

	request_data = {'issue_id':issue_id}
	pageURI = '/get_history';
	mainAjax('', request_data, 'POST',getHistoryHTML);
	
}
function getHistoryHTML(data){
	console.log(data);
	$('#history_div').html('');
	$('#history_div').html(data.rows);
}
function getComments(issue_id){
	request_data = {'issue_id':issue_id}
	pageURI = '/get_comments';
	mainAjax('', request_data, 'POST',getCommentsHTML);
}

	function getCommentsHTML(data){		
		$('#comments').html('');
		$('#comments').html(data.rows);
	}	
});
function add_comment(issue_id){
	var comment=$.trim($('#new_comment_add'+issue_id).val());
		if(comment){
			html = '';
			pageURI = '/comment/add_comment';
			request_data = {issue_id:issue_id,comment:comment}
			mainAjax('', request_data, 'POST',callAddComments);

		   /*pageURI = '/comments/send_comment_email';
			request_data = {issue_id:issue_id,comment:comment}
			mainAjax('', request_data, 'POST');*/
		}
}
function callAddComments(data){
	console.log(data);
	if(data.code==200){
			var currentTime = new Date()
			var hours = currentTime.getHours()
			var minutes = currentTime.getMinutes()
			var format ="AM";
			if(hours>11)
			{format="PM";}
			$('#new_comment_add'+data.data['issue_id']).empty('');
			$('#new_comment_add'+data.data['issue_id']).val('');
			$('#ulcomment'+data.data['issue_id']).append("<li id=comments"+data.data['id']+"><a href=javascript:void(0) class=feed-action></a>" +
				"<img src='<?php echo $loged_user_image;?>' style='width:50px;height:50px'><p>" +
				"<a class='commenter' href='javascript:void(0)'>"+username+"</a>" +
				"<br><span id='comment_text"+data.data['id']+"'>"+data.data['detail']+"</span></p>"+
				"<span class=nus-timestamp'>"+hours+":"+minutes+" "+format+"</span>" +
				"<span class=nus-timestamp><a  onclick=edit_comment("+data.data['id']+","+data.data['created_by']+","+data.data['issue_id']+")><i class='fa fa-pencil'></i></a></span>" +
				"&nbsp;<span class=nus-timestamp><a href=javascript:void(0) onclick=delete_comment("+data.data['id']+","+data.data['created_by']+","+data.data['issue_id']+")><i class='fa fa-times'></i></a></span>" +
				"" + "</li>");
		}
}
function edit_comment(commentid,userid,issueid){
	$('#liedit'+commentid).remove();
		$('#comments'+commentid).append("<li id='liedit"+commentid+"'><textarea id='editcomment"+commentid+"' style='height:100px;width:500px;' class='form-control'>"+$('#comment_text'+commentid).text()+"</textarea><input type=button class=post-comment value=Update  onclick='update_comment("+commentid+','+issueid+")'></li>");
}
function update_comment(commentid,issueid){
		var comment=$.trim($('#editcomment'+commentid).val());
		if(comment){
			pageURI = '/comment/update_comment';
			request_data = {commentid:commentid,comment:comment,issue_id:issueid}
			mainAjax('', request_data, 'POST',callUpdateComment);

		/*	pageURI = '/comments/send_comment_email';
			request_data = {jobid:jobid,comment:comment}
			mainAjax('', request_data, 'POST');*/
		}
}
function callUpdateComment(data){
	console.log(data);
	if(data.code==200){
		console.log(data.data);
		$('#liedit'+data.data['id']).html('');
		$('#comment_text'+data.data['id']).html(data.data['detail']);
	}
}
function delete_comment(commentid,userid,issue_id){
	if(confirm('Are you sure to delete this record?')){
		$('#comments'+commentid).remove();
		pageURI = '/comment/delete_comment';
		request_data = {commentid:commentid,issue_id:issue_id}
		mainAjax('', request_data, 'POST');	
	}
}
</script>
@stop