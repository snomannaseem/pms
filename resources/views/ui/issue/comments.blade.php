
<div class="comments margin-top-25px" >


    <ul id="ulcomment<?php echo $data['issue_id'];?>" class="media-list">

        <?php
            if(!empty($comments_data)){
            foreach($comments_data as $comment){
        ?>

        <li id="comments<?php echo $comment['id'];?>" class="media">
            <a href="javascript:void(0)" class="feed-action pull-left">
				<img id="" class="img-circle" alt="image" src="{{asset('user_images/default.jpg')}}" style="width:50px;height: 50px;">
			</a>				
            <div class="media-body">
                <a class="commenter" href="javascript:void(0)"><?php echo $comment['username'];;?></a>

            <br>
                <span id="comment_text<?php echo $comment['id'];?>"><?php echo $comment['detail'];?></span>
                <br>
                <span class="nus-timestamp">
					<small>
                     <span class="nus-timestamp text-muted">Posted: &nbsp;<?php echo $comment['created_on'];?></span>
					 </small>
						
                        <?php if($userdata['userid']==$comment['userid']){?>
						
                        <span class="label label_color">						
						<a href="javascript:void(0)" onclick=edit_comment("<?php echo $comment['id'];?>","<?php echo $comment['userid'];?>","<?php echo $data['issue_id'];?>")><i class='fa fa-pencil'></i></a></span>
						
						<span class="label label_color">
                        <a href="javascript:void(0)" onclick=delete_comment("<?php echo $comment['id'];?>","<?php echo $comment['userid'];?>","<?php echo $data['issue_id'];?>")><i class='fa fa-times'></i></a></span>
                    <?php }?>
            </div>

        </li>

        <?php
            }}
        ?>
    </ul>

    <ul class="media-list m-t-15">

        <li id="user_add_comment" style="" >
			<div class="form-group">
            <textarea class="form-control" placeholder="Add Comment ......." id="new_comment_add<?php echo $data['issue_id'];?>"></textarea>
			</div>
			<div class="form-group">
            <input class="btn btn-info" type="button" class="post-comment margin-top-15px" value="Submit" onclick="add_comment('<?php echo $data['issue_id'];?>')">
			</div>

        </li>
    </ul>
</div>