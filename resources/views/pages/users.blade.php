@extends('layouts.default')
@section('content')
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel">
                                <header class="panel-heading">
								{{$title}}
                                </header>
                                <div class="panel-body table-responsive">
                                    <div class="box-tools m-b-15">
                                        <div class="input-group">
											<button id="btn_add" type="button" class="btn btn-primary pull-left">Add</button>
                                            <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-hover">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
											<th>Email</th>
											<th>Projects</th>
											<th>Status</th>
											<th>Created On</th>
											<th>&nbsp;</th>
                                        </tr>
										
                                        <tr>
                                            <td>183</td>
                                            <td>John Doe</td>
                                            <td>abc@email.com</td>
                                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
											<td><span class="label label-success">Approved</span></td>
											<td>11-7-2014</td>
											<td>
                                                  <button id="btn_edit" rid="101" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></button>
												  <button id="btn_del" rid="101" class="btn btn-default btn-xs"><i class="fa fa-times"></i></button>
											</td>
                                        </tr>
                                        <tr>
                                            <td colspan="7">&nbsp;</td>
                                        </tr>
                                    
                                    </table>
									
									<div class="table-foot">
                                        <ul class="pagination pagination-sm no-margin pull-right">
                                        <li><a href="#">&laquo;</a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">&raquo;</a></li>
                                    </ul>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section>

@stop
@section('client_script')
<script type="text/javascript">
	var grid_list_page_name = 'users';
	var grid_edit_page_name = 'user';
</script>
<script src="js/pages/grid.js" type="text/javascript">
</script>
@stop