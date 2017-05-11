
<div class="comments margin-top-25px" >


    <ul id="" class="media-list">

        <?php
            if(!empty($history_data['rows'])){
            foreach($history_data['rows'] as $row){
        ?>

        <li id="comments" class="media">
            <a class="pull-left" href="javascript:void(0)" class="feed-action">
				<img id="" class="img-circle" alt="image" src="{{asset('user_images/default.jpg')}}" style="width:50px;height: 50px;">
			</a>
				
            <div class="media-body ">
               
				<div class="text-muted">
                <span id="comment_text<?php echo $row['id'];?>">  <a class="commenter" href="javascript:void(0)"><?php echo $row['username'];;?></a>
 <?php echo $row['comment'];?></span>

                <span class="nus-timestamp">
					<small>
						<span class="nus-timestamp">at: &nbsp;<?php echo $row['created_on'];?></span>
					</small>
				</span>
				</div>
                        
            </div>

        </li>

        <?php
            }}
        ?>
    </ul>

   
</div>