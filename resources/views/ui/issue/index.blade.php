@extends('ui.layouts.default')
@section('page_title', 'Issues List')
@section('content')
                <section class="content">
				
					<p id="message" style="display:<?php echo Session::has('message') ? "block":"none";?>" class="alert alert-success" >
					@if(Session::has('message'))
						
						{{ Session::get('message') }}
						
					@endif
					</p>
				
                    <div id="main" class="row">
					<input type="hidden" value="{{ csrf_token() }}" name="_token" id="_token">
                        <div class="col-xs-12">
                            <div class="panel">
                                <header class="panel-heading">Issues List  </header>
								<div class="panel-body table-responsive">
								<form id="camp_search">
                                    <div class="box-tools m-b-15">
                                        <div class="input-group">
											<button  id="btn_add" type="button" class="btn btn-primary pull-left">Add</button>
                                            <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
									</form>
									<div class="grid_box" id="this_grid">
									<?php 
										#dd($data_set);
									?>
									@include('ui.issue.issue_grid',['header' => $header , 'paging_result_set' => $result_set])
									</div>
									
									@include('ui.common.paging',['paging_result_set' => $result_set])
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section>
				



@stop
@section('client_script')
<?php 

//$order_by =  $result_set['order'];
//$sort_by =  $result_set['sort_by'];
?>
<script type="text/javascript">
	var grid_list_page_name = 'projects list';
	var grid_edit_page_name = 'projects list';
</script>

<script src="js/pages/pagingv2.js" type="text/javascript">
</script>

<script type="text/javascript">
       $(document).ready(function(){
       
		if(!paging_bg){
				  
                var paging_bg = new AdpadPaging(
                        {
                            "debug" : true,
                            "forms" : [{'type': 'search', 'id': 'camp_search'}, {'type': 'settings', 'id': 'this_page'}],
                            "url" : "/issues",
                            "frm": "main",
                            "filter_by": "",
                            "search": "",
							"_token": "_token",
                            "per_page": <?php echo env('DEFAULT_PAGE_SIZE', 10); ?>,
                            "current_page": 1,
                            "total_pages" : <?php echo $result_set['pages_count']?>,
                            "order": '<?php echo $order_by ?>',
                            "sort_by": '<?php echo $sort_by?>',
                            "this_grid" : "this_grid",
                            "before_send_callback": function(){
                                //console.log('before send callback');
                                //toggleSrcLock();
                                //  $('.msg_ok ,  .msg_error').hide();
                            },
                            "complete_callback" : function(){
                                //toggleSrcLock();
                            }
                        }
                );
            }

			/*Create */
			$('#btn_add').click(function(){
				 window.location = '/issue/add';
			});
			/*Edit */
			$(document).on("click", ".btn_edit", function(){
				 window.location = 'issue' + '/' + $(this).attr('rid');
			});
			/*View page*/
			$(document).on("click", ".btn_view", function(){
				window.location = 'issue' + '/view/' + $(this).attr('rid');
			});
        });
</script>
@stop