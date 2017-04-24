
<div class="comments margin-top-25px" >


    <ul id="" class="">

        <?php
            if(!empty($history_data['rows'])){
            foreach($history_data['rows'] as $row){
        ?>

        <li id="comments">
            <a href="javascript:void(0)" class="feed-action"></a>
				<img id="" class="" alt="image" src="{{asset('user_images/default.jpg')}}" style="width:50px;height: 50px;">
            <p>
                <a class="commenter" href="javascript:void(0)"><?php echo $row['username'];;?></a>

                <span id="comment_text<?php echo $row['id'];?>"><?php echo $row['comment'];?></span>

                <span class="nus-timestamp">
                     <span class="nus-timestamp">At :<?php echo $row['created_on'];?></span>
                        
            </p>

        </li>

        <?php
            }}
        ?>
    </ul>

   
</div>