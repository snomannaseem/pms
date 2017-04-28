@extends('ui.layouts.default')
@section('content')
                <section class="content">
				
					
				
                    <div id="main" class="row">
					
                        <div class="col-xs-12">
                            <div class="panel">
                                <header class="panel-heading">
								{{$title}}
                                </header>
								<div class="panel-body table-responsive">
								<form id="camp_search">
                                    <div class="box-tools m-b-15">
                                        <div class="input-group">
											<!-- button  id="btn_add" type="button" class="btn btn-primary pull-left">Add</button>
                                            <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div -->
                                        </div>
                                    </div>
									<p><a href="/dashboard/1">eZanga</a></p>
									<p><a href="/dashboard/17">NetStride</a></p>
									<p>&nbsp;</p>
									<p>&nbsp;</p>
									</form>
									
										
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section>

@stop
@section('client_script')

</script>
@stop