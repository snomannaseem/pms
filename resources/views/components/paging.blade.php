<?php
/**
 * Created by PhpStorm.
 * User: atif-ibrahim
 * Date: 12/10/15
 * Time: 7:09 PM
 */
?>
<?php
$total_pages = $paging_result_set['pages_count'];
$page_num = $paging_result_set['page_num'];//$params['page_num'];
$page_size = $paging_result_set['page_size'];
$total_rows = $paging_result_set['total_rows'];

$previous_page = $page_num -1 ;
$next_page = $page_num+1;
if($previous_page == 0) $previous_page = $previous_page+1;
if($next_page > $total_pages) $next_page = $next_page-1;
//Modified as requiremnt when no. of record zero showing 1 of 0 page in pagination bar
if($total_rows<=0){$page_num =0;}
?>
 <form method="post" id="this_page">
<div id="paging_container_div" class="opt_bar">
		
		<div class="table-foot">
			<ul class="pagination-sm no-margin pull-right paging">
				<li><a id="pprev"   href=''>Prev</a></li>
				<li><a id="pnext"  href=''>Next</a></li>
			</ul>
		</div>
		
    <div class="page_range" id="page_range_text">Showing page {{$page_num}} of {{$total_pages}}</div>
   
        <div class="goto">
            <label>Go to page:</label>
            <input type="text" name="goto" id="goto" value="1" />
            <a class="btn" id="paging_settings" href="javascript:void(0);">GO</a>
        </div>
        <div class="show_row">
            <label>Show rows:</label>
            <select  name="page_size" id="page_size" !id="show_row" !name="show_row">
            <option value="2" <?php echo $page_size==2 ? 'selected="selected"':'';?>>2</option>
            <option value="3" <?php echo $page_size==3 ? 'selected=""':'';?>>3</option>
            <option value="5" <?php echo $page_size==5 ? 'selected="selected"':'';?> >5</option>
            <option value="10" <?php echo $page_size==10 ? 'selected="selected"':'';?> >10</option>
            <option value="20" <?php echo $page_size==20 ? 'selected="selected"':'';?> >20</option>
            <option value="30" <?php echo $page_size==30 ? 'selected="selected"':'';?> >30</option>
            <option value="50" <?php echo $page_size==50 ? 'selected="selected"':'';?> >50</option>
            <option value="100" <?php echo $page_size==100 ? 'selected="selected"':'';?> >100</option>
            </select>
        </div>
		

									
        <input type = 'hidden' name = 'static_prefix' id = 'static_prefix' value='{{urlencode(Route::current()->getCompiled()->getStaticPrefix())}}' />
   
    <?php

    $is_download = isset($is_download) ? $is_download : false;
    $is_no_of_rec = isset($is_no_of_rec) ? $is_no_of_rec : false;

    if($is_no_of_rec){
    ?>
    <div class="download_menu fl_left">
        <div class="page_range" id="is_no_of_rec">Total Records: <span id="row_span">{{number_format($total_rows)}}</span></div>
    </div>
    <?php }?>


</div>
 </form>