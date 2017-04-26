
<div class="col-md-7">
	<section class="panel tasks-widget">
		<header class="panel-heading">Subtask list</header>
		<div class="panel-body">

			<div class="task-content">
                      <ul class="task-list ui-sortable">
							<?php   
								$project_id = '';
								$cat_id  = '';
								
								foreach($substask_data['rows'] as $task) {
									$project_id = $task['project_id'];
									$cat_id = $task['cat_id'];
									$priroty = $task['pirority_name'];
									$label = "success";
									if(strtolower($priroty) =="highest"){ $label = "danger";}
									if(strtolower($priroty) =="high"){ $label = "inverse";}
									if(strtolower($priroty) =="medium"){ $label = "warning";}
									if(strtolower($priroty) =="low"){ $label = "primary";}
								?>
							
                                      <li>
                                          <div class="task-checkbox">
                                              <span class="task-title-sp"><?php echo $task['issue_id'];?></span>
                                          </div>
                                          <div class="task-title">
                                              <span class="task-title-sp"><?php echo $task['issue_title'];?></span>
                                              <span class="label label-<?php echo $label;?>"><?php echo ucfirst($priroty) ;?></span>
											  <br>&nbsp;&nbsp;<span class="task-title-sp"><small> Assgined to <?php echo ucfirst($task['username']) ;?></small></span>
                                              <div class="pull-right hidden-phone">
                                                  <button rid="<?php echo $task['issue_id'];?>" class="btn btn-default btn-xs btn_view "><i class="glyphicon glyphicon-eye-open"></i></button>
                                                  <button  rid="<?php echo $task['issue_id'];?>"  class="btn btn-default btn-xs btn_edit"><i class="fa fa-pencil"></i></button>
                                                  
                                              </div>
                                          </div>
                                      </li>
							<?php } ?>
                                      
                                  </ul>
								  <?php  if(count($substask_data['rows'])==0){ ?>
									<div class="task-checkbox"> Subtask not found</div>
								<?php } ?>
                              </div>

				  <div class=" add-task-row">
					  <a target="_new"class="btn btn-success btn-sm pull-left" href="/issue/add/?type=subtask&parent_issue_type=<?php echo $parent_issue_id;?>&project_id=<?php echo $project_id;?>&cat_id=<?php echo $cat_id;?>">Add New SubTask</a>
					  <a target= "_new"  class="btn btn-default btn-sm pull-right" href="/issues">See All Tasks</a>
				  </div>
		</div>
	</section>
</div>