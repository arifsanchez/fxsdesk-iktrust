
	
<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>
<?php echo $this->Search->searchForm('User', array('legend' => false, 'updateDivId' => 'updateUserIndex')); ?>
<?php echo $this->element('Usermgmt.paginator', array('useAjax' => true, 'updateDivId' => 'updateUserIndex')); ?>


				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-table"></i>
									All Users
								</h3>
							</div>
							<div class="box-content nopadding">
									<table class="table table-hover table-nomargin table-bordered dataTable dataTable-fixedcolumn dataTable-scroll-x dataTable-scroll-y">
									<thead>
										<tr>
											
											<th class="sorting"><?php echo $this->Paginator->sort('User.id', __('User Id')); ?></th>
											<th><?php echo __('Photo');?></th>
											<th class="sorting"><?php echo $this->Paginator->sort('User.first_name', __('Name')); ?></th>
											<th class="sorting"><?php echo $this->Paginator->sort('User.username', __('Username')); ?></th>
											<th class="sorting"><?php echo $this->Paginator->sort('User.email', __('Email')); ?></th>
											<th class="sorting"><?php echo $this->Paginator->sort('User.email_verified', __('Email Verified')); ?></th>
											<th class="sorting"><?php echo $this->Paginator->sort('User.active', __('Status')); ?></th>
											<th class="sorting"><?php echo $this->Paginator->sort('User.created', __('Created')); ?></th>
											<th style="width:150px;"><?php echo __('Action');?></th>
										</tr>
									</thead>
									<tbody>
								<?php   if (!empty($users)) {
											#debug($users); die();
											$page = $this->request->params['paging']['User']['page'];
											$limit = $this->request->params['paging']['User']['limit'];
											$i=($page-1) * $limit;
											foreach ($users as $row) {
												$i++;
												echo "<tr id='rowId".$row['User']['id']."'>";
												//echo "<td>".$i."</td>";
												echo "<td>".$row['User']['id']."</td>";
												echo "<td><img src='".$this->Image->resize('img/'.IMG_DIR, $row['UserDetail']['photo'], 60, null, true)."'></td>";
												echo "<td>".h($row['User']['first_name'])." ".h($row['User']['last_name'])."</td>";
												if($row['User']['fb_id'] == null){
													echo "<td><a href='".SITE_URL."".h($row['User']['username'])."'>".h($row['User']['username'])."</a></td>";
												} else {
													echo "<td><a href='https://facebook.com/".h($row['User']['username'])."'>".h($row['User']['username'])."</a></td>";
												}
												echo "<td>".h($row['User']['email'])."</td>";
												
												echo "<td id='emailVerified".$row['User']['id']."'>";
												if ($row['User']['email_verified']==1) {
													echo __('Yes');
												} else {
													echo __('No');
												}
												echo"</td>";
												echo "<td id='activeInactive".$row['User']['id']."'>";
												if ($row['User']['active']==1) {
													echo "<span class=\"label label-satgreen\">Active</span>";
												} else {
													echo "<span class=\"label label-lightred\">Disable</span>";
												}
												echo"</td>";
												echo "<td>".date('d-M-Y',strtotime($row['User']['created']))."</td>";
												$loadingImg = '<img src="'.SITE_URL.'usermgmt/img/loading-circle.gif">';
												echo "<td class='action'>";
												echo "<div class='btn-group'>";
												echo "<a href='#'' data-toggle='dropdown' class='btn btn-darkblue dropdown-toggle'><i class='icon-user'></i> Control Panel <span class='caret'></span></a>";
												echo "<ul class='dropdown-menu'>";
												echo"<li>";
													echo $this->Html->link("<i class='icon-user'></i> User Profile" ,
													array('controller'=>'Users', 'action'=>'viewUser', $row['User']['id'], 'page'=>$page), 
													array('escape'=>false
														   
														)
													);
                                                 echo"</li>";
                                                 echo"<li>";
													echo $this->Html->link("<i class='icon-edit'></i> Edit Profile",
														array('controller'=>'Users', 'action'=>'editUser', $row['User']['id'], 'page'=>$page),
														array('escape'=>false,
														 	
														 	)
														 );
                                                 echo"</li>";
                                                 echo"<li>";
													echo $this->Html->link("<i class='icon-unlock'></i> Change Password",

													 array('controller'=>'Users', 'action'=>'changeUserPassword', $row['User']['id'], 'page'=>$page), 
													 array('escape'=>false));
												echo"</li>";
												echo"<li>";

													if ($row['User']['id']!=1 && strtolower($row['User']['username']) !='admin') {
														if ($row['User']['active']==0) {
															$activeInactiveImg = "<i class='icon-thumbs-up'></i> Activate";
														} else {
															$activeInactiveImg = "<i class='icon-thumbs-down'></i> Deactivate";
														}
														echo $this->Js->link($activeInactiveImg, array('action' => 'makeActiveInactive', $row['User']['id']), array('escape' => false, 'before'=>"var targetId = event.currentTarget.id; $('#'+targetId).html('".$loadingImg."');", 'success'=>"var targetId = event.currentTarget.id; if(data) { $('#'+targetId).html(data); }"));
													}
													if ($row['User']['id']!=1 && strtolower($row['User']['username']) !='admin') {
														if ($row['User']['email_verified']==0) {
															echo $this->Js->link($this->Html->image(SITE_URL.'usermgmt/img/email-verify.png', array('alt' => __('Verify Email'), 'title' => __('Verify Email'))), array('action' => 'verifyEmail', $row['User']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to verify email of this user?'), 'before'=>"var targetId = event.currentTarget.id; $('#'+targetId).html('".$loadingImg."');", 'success'=>"var targetId = event.currentTarget.id; $('#'+targetId).html(data);"));
														}
													}
													echo"</li>";
													echo"<li>";
													if ($row['User']['id']!=1 && strtolower($row['User']['username']) !='admin') {
														echo $this->Js->link(
															"<i class='icon-remove'></i> Delete User", 
															
															array('action' => 'deleteUser', $row['User']['id']), 
															array(
																
																'escape' => false, 
																'confirm' => __('Are you sure you want to delete this user?'), 
																'before'=>"var targetId = event.currentTarget.id; $('#'+targetId).html('".$loadingImg."');", 'success'=>"var targetId = event.currentTarget.id; if(data=='1') { $('#rowId".$row['User']['id']."').hide('slow', function(){ $(this).remove(); }); } else { $('#'+targetId).html(data); }"
															)
														);
													}
													echo"</li>";
													echo"<li>";
													echo $this->Html->link("<i class='icon-warning-sign'></i> Permissions", 
														
													    array('controller'=>'Users', 'action'=>'viewUserPermissions', $row['User']['id'], 'page'=>$page), array('escape'=>false));
                                                    echo"</li>";
                                                    echo"<li>";
													echo $this->Html->link("<i class='icon-envelope-alt'></i> Send Email",

														array('controller'=>'UserEmails', 'action'=>'sendToUser', $row['User']['id'], 'page'=>$page), array('escape'=>false));
													echo"</li>";
													echo"</div>";

												echo "</td>";
												echo "</tr>";
											}
										} else {
											echo "<tr><td colspan=10><br/><br/>".__('No Data')."</td></tr>";
										} ?>
									</tbody>
								</table>
								<?php if(!empty($users)) { echo $this->element('Usermgmt.pagination', array("totolText" => __('Number of Users'))); } ?>
							</div>
						</div>
					</div>
				</div>
