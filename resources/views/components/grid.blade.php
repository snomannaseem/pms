<?php
        //dd($paging_result_set);
    //$rows = $paging_result_set['object_array'];
    $sort_by = $paging_result_set['sort_by'];
    $order = $paging_result_set['order'];
    
?>
<div id="preloader_grid"  class="preloader" style="display:none;"></div>

<table class="table table-hover" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody>
    <tr>
		<?php
        foreach($header as $column_name => $column_title)
        {
            if(is_array($column_title) && isset($column_title['sorting']) && $column_title['sorting'] == false)
            {
            ?>
                <td class="no_sort" style="cursor:default"><?php echo $column_title['title']; ?></td>
            <?php
            }
            else{
                $c = "";
                if($column_name == $sort_by) $c = $order;
            ?>
                <th onClick="pGridHeaderClick(event)" class=" {{$c}}" column_name="{{$column_name}}">
                    <?php
                            echo $column_title ;
                    ?>
                </th>
            <?php
            }
        }
            ?>
    </tr>
    <?php

    if ($rows == ""){
        print "<tr><td colspan='". count($header). "'>No data available</td></tr>";
    }
    echo $rows;
    ?>
    </tbody></table>