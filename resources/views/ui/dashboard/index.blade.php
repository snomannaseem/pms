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
								<?php if($error !== "") { ?><div class="alert  alert-danger" ><?php echo $error; ?></div>
								<?php } ?>
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
									<?php 
									
									foreach($myteams as $myteam) {
									//dd($roles);
									?>
										<p><a href="/teamlogin/<?php echo $myteam['id']; ?>"><?php echo $myteam['name'].' <i>As</i> '.$roles[(int)$myteam['role_id']]['role']; ?></a></p>
									<?php
									}
									?>
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