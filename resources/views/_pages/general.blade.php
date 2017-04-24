@extends('layouts.default')
@section('content')


                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <!--breadcrumbs start -->
                            <ul class="breadcrumb">
                                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                                <li><a href="#">Dashboard</a></li>
                                <li class="active">Current page</li>
                            </ul>
                            <!--breadcrumbs end -->
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-2">
                            <div class="stat">
                                <div class="stat-icon" style="color:#fa8564;">
                                    <i class="fa fa-file-o fa-3x stat-elem"></i>
                                </div>
                                <h5 class="stat-info">999 Projects</h5>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="stat">
                                <div class="stat-icon" style="color:#45cf95;">
                                    <i class="fa fa-paperclip fa-3x stat-elem"></i>
                                </div>
                                <h5 class="stat-info">999 Documents</h5>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="stat">
                                <div class="stat-icon" style="color:#AC75F0">
                                    <i class="fa fa-envelope-o fa-3x stat-elem"></i>
                                </div>
                                <h5 class="stat-info">999 Messages</h5>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="stat">
                                <div class="stat-icon" style="color:#45cf95;">
                                    <i class="fa fa-check-square-o fa-3x stat-elem"></i>
                                </div>
                                <h5 class="stat-info">1000 Tasks</h5>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="stat">
                                <div class="stat-icon" style="color:#AC75F0">
                                    <i class="fa fa-dollar fa-3x stat-elem"></i>
                                </div>
                                <h5 class="stat-info">$99999 Earnings</h5>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="stat">
                                <div class="stat-icon" style="color:#fa8564">
                                    <i class="fa fa-refresh fa-spin fa-3x stat-elem"></i>
                                </div>
                                <h5 class="stat-info">Procesing....</h5>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <!--progress bar start-->
                                    <section class="panel">
                                        <header class="panel-heading">
                                            Basic Progress Bars
                                        </header>
                                        <div class="panel-body"><p><code>.progress</code></p>
                                          <div class="progress">
                                            <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                              <span class="sr-only">40% Complete (success)</span>
                                            </div>
                                          </div>
                                          <p>Class: <code>.sm</code></p>
                                          <div class="progress progress-sm active">
                                            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                              <span class="sr-only">20% Complete</span>
                                            </div>
                                          </div>
                                          <p>Class: <code>.xs</code></p>
                                          <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                              <span class="sr-only">60% Complete (warning)</span>
                                            </div>
                                          </div>
                                          <p>Class: <code>.xxs</code></p>
                                          <div class="progress progress-xxs">
                                            <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                              <span class="sr-only">60% Complete (warning)</span>
                                            </div>
                                          </div>
                                        </div>
                                    </section>
                                    <!--progress bar end-->

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <!--progress bar start-->
                                    <section class="panel">
                                        <header class="panel-heading">
                                            Striped Progress Bars
                                        </header>
                                        <div class="panel-body">
                                            <p><code>.progress</code></p>
                                              <div class="progress progress-striped">
                                                <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                  <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                              </div>
                                              <p>Class: <code>.sm</code></p>
                                              <div class="progress progress-striped progress-sm active">
                                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                  <span class="sr-only">20% Complete</span>
                                                </div>
                                              </div>
                                              <p>Class: <code>.xs</code></p>
                                              <div class="progress progress-striped progress-xs">
                                                <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                  <span class="sr-only">60% Complete (warning)</span>
                                                </div>
                                              </div>
                                              <p>Class: <code>.xxs</code></p>
                                              <div class="progress progress-striped progress-xxs">
                                                <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                  <span class="sr-only">60% Complete (warning)</span>
                                                </div>
                                              </div>
                                        </div>
                                    </section>
                                    <!--progress bar end-->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <!--tooltips start-->
                                    <section class="panel">
                                        <div class="panel-body btn-gap">
                                            <button title="" data-placement="top" data-toggle="tooltip" class="btn btn-default tooltips" type="button" data-original-title="Tooltip on top">Tooltip on top</button>
                                            <button title="" data-placement="left" data-toggle="tooltip" class="btn btn-default tooltips" type="button" data-original-title="Tooltip on left"> left</button>
                                            <button title="" data-placement="bottom" data-toggle="tooltip " class="btn btn-default tooltips" type="button" data-original-title="Tooltip on bottom"> bottom</button>
                                            <button title="" data-placement="right" data-toggle="tooltip" class="btn btn-default tooltips" type="button" data-original-title="Tooltip on right"> right</button>
                                        </div>
                                    </section>
                                    <!--tooltips end-->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <!--pagination start-->
                                    <section class="panel">
                                        <header class="panel-heading">
                                            Pagination
                                        </header>
                                        <div class="panel-body">
                                            <div>
                                                <ul class="pagination pagination-lg">
                                                    <li><a href="#">�</a></li>
                                                    <li><a href="#">1</a></li>
                                                    <li><a href="#">2</a></li>
                                                    <li><a href="#">3</a></li>
                                                    <li><a href="#">4</a></li>
                                                    <li><a href="#">5</a></li>
                                                    <li><a href="#">�</a></li>
                                                </ul>
                                            </div>
                                            <div class="text-center">
                                                <ul class="pagination">
                                                    <li><a href="#">�</a></li>
                                                    <li><a href="#">1</a></li>
                                                    <li><a href="#">2</a></li>
                                                    <li><a href="#">3</a></li>
                                                    <li><a href="#">4</a></li>
                                                    <li><a href="#">5</a></li>
                                                    <li><a href="#">�</a></li>
                                                </ul>
                                            </div>
                                            <div>
                                                <ul class="pagination pagination-sm pull-right">
                                                    <li><a href="#">�</a></li>
                                                    <li><a href="#">1</a></li>
                                                    <li><a href="#">2</a></li>
                                                    <li><a href="#">3</a></li>
                                                    <li><a href="#">4</a></li>
                                                    <li><a href="#">5</a></li>
                                                    <li><a href="#">�</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <h3>Default Example</h3>
                                        <nav>
                                          <ul class="pager">
                                            <li><a href="#">Previous</a></li>
                                            <li><a href="#">Next</a></li>
                                          </ul>
                                        </nav>
                                        <h3>Aligned links</h3>
                                        <nav>
                                          <ul class="pager">
                                            <li class="previous"><a href="#"><span aria-hidden="true">&larr;</span> Older</a></li>
                                            <li class="next"><a href="#">Newer <span aria-hidden="true">&rarr;</span></a></li>
                                          </ul>
                                        </nav>
                                    </section>
                                    <!--pagination end-->
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6">
                        <!--tab nav start-->
                        <section class="panel general">
                            <header class="panel-heading tab-bg-dark-navy-blue">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a data-toggle="tab" href="#home">Home</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#about">About</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#profile">Profile</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#contact">Contact</a>
                                    </li>
                                </ul>
                            </header>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div id="home" class="tab-pane active">
                                        Home
                                    </div>
                                    <div id="about" class="tab-pane">About</div>
                                    <div id="profile" class="tab-pane">Profile</div>
                                    <div id="contact" class="tab-pane">Contact</div>
                                </div>
                            </div>
                        </section>
                        <!--tab nav start-->

                        <!--tab nav start-->
                        <section class="panel general">
                            <header class="panel-heading tab-bg-dark-navy-blue">
                                <ul class="nav nav-tabs">
                                    <li>
                                        <a data-toggle="tab" href="#home-2">
                                            <i class="fa fa-home"></i>
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a data-toggle="tab" href="#about-2">
                                            <i class="fa fa-user"></i>
                                            About
                                        </a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#contact-2">
                                            <i class="fa fa-envelope-o"></i>
                                            Contact
                                        </a>
                                    </li>
                                </ul>
                            </header>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div id="home-2" class="tab-pane ">
                                        Home
                                    </div>
                                    <div id="about-2" class="tab-pane active">About</div>
                                    <div id="contact-2" class="tab-pane ">Contact</div>
                                </div>
                            </div>
                        </section>
                        <!--tab nav end-->


                        <!--tab nav start-->
                        <section class="panel">
                            <header class="panel-heading tab-bg-dark-navy-blue tab-right ">
                                <ul class="nav nav-tabs pull-right">
                                    <li class="active">
                                        <a data-toggle="tab" href="#home-3">
                                            <i class="fa fa-home"></i>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#about-3">
                                            <i class="fa fa-user"></i>
                                            About
                                        </a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#contact-3">
                                            <i class="fa fa-envelope-o"></i>
                                            Contact
                                        </a>
                                    </li>
                                </ul>
                            </header>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div id="home-3" class="tab-pane active">
                                        Home
                                    </div>
                                    <div id="about-3" class="tab-pane">About</div>
                                    <div id="contact-3" class="tab-pane">Contact</div>
                                </div>
                            </div>
                        </section>
                        <!--tab nav end-->



                        <div class="row">
                            <div class="col-md-12">
                                <!--notification start-->
                                <section class="panel">
                                    <div class="panel-body">

                                        <div class="alert alert-block alert-danger ">
                                            <button data-dismiss="alert" class="close close-sm" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <strong>Oh snap!</strong> Change a few things up and try submitting again.
                                        </div>
                                        <div class="alert alert-success ">
                                            <button data-dismiss="alert" class="close close-sm" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <strong>Well done!</strong> You successfully read this important alert message.
                                        </div>
                                        <div class="alert alert-info ">
                                            <button data-dismiss="alert" class="close close-sm" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
                                        </div>
                                        <div class="alert alert-warning ">
                                            <button data-dismiss="alert" class="close close-sm" type="button">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <strong>Warning!</strong> Best check yo self, you're not looking too good.
                                        </div>

                                    </div>
                                </section>
                                <!--notification end-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <section class="panel">
                                <header class="panel-heading">
                                    Default Buttons
                                </header>
                                <div class="panel-body">
                                    <button type="button" class="btn btn-default">Default</button>
                                    <button type="button" class="btn btn-primary">Primary</button>
                                    <button type="button" class="btn btn-success">Success</button>
                                    <button type="button" class="btn btn-info">Info</button>
                                    <button type="button" class="btn btn-warning">Warning</button>
                                    <button type="button" class="btn btn-danger">Danger</button>

                                        <p class="text-muted text-center">Labels</p>
                                        <p class="text-center">
                                            <span class="label label-default">label</span>
                                            <span class="label label-primary">Primary</span>
                                            <span class="label label-success">Success</span>
                                            <span class="label label-info">Info</span>
                                            <span class="label label-inverse">Inverse</span>
                                            <span class="label label-warning">Warning</span>
                                            <span class="label label-danger">Danger</span>
                                        </p>
                                        <p class="text-muted text-center">Badges</p>
                                        <p class="m-bot-none text-center">
                                            <span class="badge">5</span>
                                            <span class="badge badge-primary">10</span>
                                            <span class="badge badge-success">15</span>
                                            <span class="badge badge-info">20</span>
                                            <span class="badge badge-inverse">25</span>
                                            <span class="badge badge-warning">30</span>
                                            <span class="badge badge-danger">35</span>
                                        </p>
                                        <h3>Modals</h3>
                                        <a class="btn btn-success" data-toggle="modal" href="#myModal">
                                            Dialog
                                        </a>
                                        <a class="btn btn-warning" data-toggle="modal" href="#myModal2">
                                            Confirm
                                        </a>
                                        <a class="btn btn-danger" data-toggle="modal" href="#myModal3">
                                            Alert !
                                        </a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                                                        <h4 class="modal-title">Modal Tittle</h4>
                                                    </div>
                                                    <div class="modal-body">

                                                        Body goes here...

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                                        <button class="btn btn-success" type="button">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal -->
                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                                                        <h4 class="modal-title">Modal Tittle</h4>
                                                    </div>
                                                    <div class="modal-body">

                                                        Body goes here...

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                                                        <button class="btn btn-warning" type="button"> Confirm</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal -->
                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                                                        <h4 class="modal-title">Modal Tittle</h4>
                                                    </div>
                                                    <div class="modal-body">

                                                        Body goes here...

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-danger" type="button"> Ok</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal -->



                                </div>
                            </section>
                            </div>
                        </div>


                        </div>

                    </div>

                </section>
            </div>
@stop