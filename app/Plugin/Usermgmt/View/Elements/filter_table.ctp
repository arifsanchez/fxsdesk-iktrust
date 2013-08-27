
	
<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>

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
								<table class="table table-hover table-nomargin table-bordered dataTable-columnfilter dataTable">
									<thead>
										<tr class='thefilter'>
											<th>SL</th>
											<th>User Id</th>
											<th>Name</th>
											<th>Username</th>
											<th>Email</th>
											<th>Groups(s)</th>
											<th>Email Verified</th>
											<th>Status</th>
											<th>Created</th>
											<th>Action</th>
										</tr>
										<tr>
										    <th>SL</th>
											<th>User Id</th>
											<th>Name</th>
											<th>Username</th>
											<th>Email</th>
											<th>Groups(s)</th>
											<th>Email Verified</th>
											<th>Status</th>
											<th>Created</th>
											<th>Action</th>
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
												echo "<td>".$i."</td>";
												echo "<td>".$row['User']['id']."</td>";
												echo "<td>".h($row['User']['first_name'])." ".h($row['User']['last_name'])."</td>";
												if($row['User']['fb_id'] == null){
													echo "<td><a href='".SITE_URL."".h($row['User']['username'])."'>".h($row['User']['username'])."</a></td>";
												} else {
													echo "<td><a href='https://facebook.com/".h($row['User']['username'])."'>".h($row['User']['username'])."</a></td>";
												}
												echo "<td>".h($row['User']['email'])."</td>";
												echo "<td>".h($row['UserGroup']['name'])."</td>";
												echo "<td id='emailVerified".$row['User']['id']."'>";
												if ($row['User']['email_verified']==1) {
													echo __('Yes');
												} else {
													echo __('No');
												}
												echo"</td>";
												echo "<td id='activeInactive".$row['User']['id']."'>";
												if ($row['User']['active']==1) {
													echo __('Active');
												} else {
													echo __('Inactive');
												}
												echo"</td>";
												echo "<td>".date('d-M-Y',strtotime($row['User']['created']))."</td>";
												$loadingImg = '<img src="'.SITE_URL.'usermgmt/img/loading-circle.gif">';
												echo "<td class='action'>";
													echo $this->Html->link($this->Html->image(SITE_URL.'usermgmt/img/view.png', 
													
													array('alt' => __('View'), 'title' => __('View User'))), 
													array('controller'=>'Users', 'action'=>'viewUser', $row['User']['id'], 'page'=>$page), 
													array('escape'=>false));

													echo $this->Html->link($this->Html->image(SITE_URL.'usermgmt/img/edit.png', array('alt' => __('Edit'), 'title' => __('Edit User'))), array('controller'=>'Users', 'action'=>'editUser', $row['User']['id'], 'page'=>$page), array('escape'=>false));

													echo $this->Html->link($this->Html->image(SITE_URL.'usermgmt/img/password.png', array('alt' => __('Change Password'), 'title' => __('Change Password'))), array('controller'=>'Users', 'action'=>'changeUserPassword', $row['User']['id'], 'page'=>$page), array('escape'=>false));

													if ($row['User']['id']!=1 && strtolower($row['User']['username']) !='admin') {
														if ($row['User']['active']==0) {
															$activeInactiveImg = $this->Html->image(SITE_URL.'usermgmt/img/dis-approve.png', array('alt' => __('Make Active'), 'title' => __('Make Active')));
														} else {
															$activeInactiveImg = $this->Html->image(SITE_URL.'usermgmt/img/approve.png', array('alt' => __('Make Inactive'), 'title' => __('Make Inactive')));
														}
														echo $this->Js->link($activeInactiveImg, array('action' => 'makeActiveInactive', $row['User']['id']), array('escape' => false, 'before'=>"var targetId = event.currentTarget.id; $('#'+targetId).html('".$loadingImg."');", 'success'=>"var targetId = event.currentTarget.id; if(data) { $('#'+targetId).html(data); }"));
													}
													if ($row['User']['id']!=1 && strtolower($row['User']['username']) !='admin') {
														if ($row['User']['email_verified']==0) {
															echo $this->Js->link($this->Html->image(SITE_URL.'usermgmt/img/email-verify.png', array('alt' => __('Verify Email'), 'title' => __('Verify Email'))), array('action' => 'verifyEmail', $row['User']['id']), array('escape' => false, 'confirm' => __('Are you sure you want to verify email of this user?'), 'before'=>"var targetId = event.currentTarget.id; $('#'+targetId).html('".$loadingImg."');", 'success'=>"var targetId = event.currentTarget.id; $('#'+targetId).html(data);"));
														}
													}
													if ($row['User']['id']!=1 && strtolower($row['User']['username']) !='admin') {
														echo $this->Js->link(
															"<i class='icon-remove'></i>", 
															
															array('action' => 'deleteUser', $row['User']['id']), 
															array(
																'class' => 'btn btn-primary',
																'escape' => false, 
																'confirm' => __('Are you sure you want to delete this user?'), 
																'before'=>"var targetId = event.currentTarget.id; $('#'+targetId).html('".$loadingImg."');", 'success'=>"var targetId = event.currentTarget.id; if(data=='1') { $('#rowId".$row['User']['id']."').hide('slow', function(){ $(this).remove(); }); } else { $('#'+targetId).html(data); }"
															)
														);
													}
													echo $this->Html->link($this->Html->image(SITE_URL.'usermgmt/img/view-permission.png', array('alt' => __('View Permissions'), 'title' => __('View Permissions'))), array('controller'=>'Users', 'action'=>'viewUserPermissions', $row['User']['id'], 'page'=>$page), array('escape'=>false));

													echo $this->Html->link($this->Html->image(SITE_URL.'usermgmt/img/send_mail.png', array('alt' => __('Send Mail'), 'title' => __('Send Mail'))), array('controller'=>'UserEmails', 'action'=>'sendToUser', $row['User']['id'], 'page'=>$page), array('escape'=>false));

												echo "</td>";
												echo "</tr>";
											}
										} else {
											echo "<tr><td colspan=10><br/><br/>".__('No Data')."</td></tr>";
										} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
