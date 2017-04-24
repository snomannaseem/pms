
<div class="comments margin-top-25px" >


    <ul id="ulcomment<?php echo $data['issue_id'];?>" class="">

        <?php
            if(!empty($comments_data)){
            foreach($comments_data as $comment){
        ?>

        <li id="comments<?php echo $comment['id'];?>">
            <a href="javascript:void(0)" class="feed-action"></a>
				<img id="" class="" alt="image" src="{{asset('user_images/default.jpg')}}" style="width:50px;height: 50px;">
            <p>
                <a class="commenter" href="javascript:void(0)"><?php echo $comment['username'];;?></a>

            <br>
                <span id="comment_text<?php echo $comment['id'];?>"><?php echo $comment['detail'];?></span>
                <br>
                <span class="nus-timestamp">
                     <span class="nus-timestamp">Posted :<?php echo $comment['created_on'];?></span>
                        <?php if($userdata['userid']==$comment['userid']){?>
                        <a href="javascript:void(0)" onclick=edit_comment("<?php echo $comment['id'];?>","<?php echo $comment['userid'];?>","<?php echo $data['issue_id'];?>")><i class='fa fa-pencil'></i></a></a></span>
                        <a href="javascript:void(0)" onclick=delete_comment("<?php echo $comment['id'];?>","<?php echo $comment['userid'];?>","<?php echo $data['issue_id'];?>")><i class='fa fa-times'></i></a></span>
                    <?php }?>
            </p>

        </li>

        <?php
            }}
        ?>
    </ul>

    <ul>

        <li id="user_add_comment" style="" >
            <textarea    style="height: 100px;width:500px; " class="form-control" placeholder="Add Comment ......." id="new_comment_add<?php echo $data['issue_id'];?>" ></textarea>
            <input type="button" class="post-comment margin-top-15px" value="Submit" onclick="add_comment('<?php echo $data['issue_id'];?>')">

        </li>
    </ul>
</div>