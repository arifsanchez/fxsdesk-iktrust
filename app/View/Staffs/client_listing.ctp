<?php
if(!isset($updateDivId)) {
	$updateDivId="updateIndex";
}
$ajax=true;
if(isset($useAjax) && !$useAjax) {
	$ajax=false;
}
if($ajax) {
	$this->Paginator->options(array(
		'update' => '#updateNetworklisting',
		'evalScripts' => true,
		'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
		'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false))
	));
}
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color box-small blue box-bordered" id="updateNetworklisting">
			<div class="box-title">
				<h3>
					Registered Trading Accounts
				</h3>
				<div class="actions">
					<style>
				    #custom-search-form {
				    margin:0;
				    margin-top: 5px;
				    padding: 0;
				    }
				    #custom-search-form .search-query {
				    padding-right: 3px;
				    padding-right: 4px \9;
				    padding-left: 3px;
				    padding-left: 4px \9;
				    /* IE7-8 doesn't have border-radius, so don't indent the padding */
				    margin-bottom: 0;
				    -webkit-border-radius: 3px;
				    -moz-border-radius: 3px;
				    border-radius: 3px;
				    }
				    #custom-search-form button {
				    border: 0;
				    background: none;
				    /** belows styles are working good */
				    padding: 2px 5px;
				    margin-top: 2px;
				    position: relative;
				    left: -28px;
				    /* IE7-8 doesn't have border-radius, so don't indent the padding */
				    margin-bottom: 0;
				    -webkit-border-radius: 3px;
				    -moz-border-radius: 3px;
				    border-radius: 3px;
				    }
				    .search-query:focus + button {
				    z-index: 3;
				    }
				    </style>
				    <form id="custom-search-form" class="form-search form-horizontal pull-right">
				    <div class="input-append span12">
				    <input type="text" class="search-query" placeholder="Search">
				    <button type="submit" class="btn"><i class="icon-search"></i></button>
				    </div>
				    </form>
				</div>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-bordered dataTable dataTable-fixedcolumn dataTable-scroll-x dataTable-scroll-y">
					<thead>
						<tr>
							
							<!--th class="sorting"><?php echo $this->Paginator->sort('User.id', __('User Id')); ?></th-->
							<th><?php echo __('Photo');?></th>
							<th class="sorting"><?php echo $this->Paginator->sort('User.first_name', __('Personal Info')); ?></th>
							<th class="sorting"><?php echo $this->Paginator->sort('User.email', __('Contact')); ?></th>
							<th>Status</th>
							<th>Accounts</th>
							<th><?php echo __('Action');?></th>
						</tr>
					</thead>
					<tbody>
					<?php if(!empty($users)) {
							#debug($users); die();
							$page = $this->request->params['paging']['User']['page'];
							$limit = $this->request->params['paging']['User']['limit'];
							$i=($page-1) * $limit;
							foreach ($users as $row) {
								#debug($row); die();
								$i++;
								#echo "<tr id='rowId".$row['User']['id']."'>";
								#echo "<td>".$i."</td>";
								#echo "<td>".$row['User']['id']."</td>";
								echo "<td><img src='".$this->Image->resize('img/'.IMG_DIR, $row['UserDetail']['photo'], 60, null, true)."'></td>";
								echo "<td>".h($row['User']['first_name'])." ".h($row['User']['last_name']);
									if($row['User']['fb_id'] == null){
										echo "<br/><a class='btn btn-mini btn-blue' href='".SITE_URL."".h($row['User']['username'])."'>".h($row['User']['username'])."</a><br/>";
									} else {
										echo "<br/><a class='btn btn-mini' href='".SITE_URL."".h($row['User']['username'])."'>".h($row['User']['username'])."</a>&nbsp;<a class='btn btn-mini btn-satblue' href='https://facebook.com/".h($row['User']['username'])."'><i class='icon-facebook-sign'></i></a><br/>";
									}
									echo "<i class='icon-flag'></i> ".date('d/m/Y',strtotime($row['User']['created']));
								echo "</td>";
								
								echo "<td>".h($row['User']['email']);
									echo "<br/>".h($row['UserDetail']['cellphone'])."</td>";
								echo "</td>";
								
								echo "<td id='activeInactive".$row['User']['id']."'>";
							
								if ($row['User']['active']==1) {
									echo "<span class=\"label label-satgreen\">Active</span>";
								} else {
									echo "<span class=\"label label-lightred\">Disable</span>";
								}

								if ($row['User']['email_verified']==1) {
									echo "<span class='label label-satgreen'><i class='icon-envelope-alt'></i></span>";
								} else {
									echo "<span class='label label-red'><i class='icon-envelope-alt'></i></span>";
								}
								echo "</td>";

								echo "<td>";
									#count total trading account under this email
									$TotalTraccship = $this->requestAction('staffs/kiraAccBawahTracc/siapa:'.$row['User']['email'].'') ;
									if(!empty($TotalTraccship)){
										echo "<span class='badge badge-warning'>".$TotalTraccship." Tracc</span><br/>";
									} else {
										echo "<span class='badge badge-success'>0 Tracc</span><br/>";
									}
									
									#count total email account under this email
									$TotalAgentship = $this->requestAction('staffs/kiraAgentBawahTracc/siapa:'.$row['User']['email'].'') ;
									if(!empty($TotalAgentship)){
										echo "<span class='badge badge-inverse'>".$TotalAgentship." Agacc</span>";
									} else {
										echo "<span class='badge badge-inverse'>0 Agacc</span>";
									}
								echo "</td>";

								#Control Panel Button - Start
								$loadingImg = '<img src="'.SITE_URL.'usermgmt/img/loading-circle.gif">';
								echo "<td class='action'>";
								echo "<div class='btn-group'>";
								echo "<a href='#'' data-toggle='dropdown' class='btn btn-mini btn-darkblue dropdown-toggle'><i class='icon-user'></i> User Panel <span class='caret'></span></a>";
								echo "<ul class='dropdown-menu'>";
								echo"<li>";
									echo $this->Html->link("<i class='icon-user'></i> User Profile" ,
									array('plugin' => 'usermgmt','controller'=>'Users', 'action'=>'viewUser', $row['User']['id'], 'page'=>$page), 
									array('escape'=>false
										   
										)
									);
                                 echo"</li>";
                                 echo"<li>";
									echo $this->Html->link("<i class='icon-edit'></i> Edit Profile",
										array('plugin' => 'usermgmt','controller'=>'Users', 'action'=>'editUser', $row['User']['id'], 'page'=>$page),
										array('escape'=>false,
										 	
										 	)
										 );
                                 echo"</li>";
                                 echo"<li>";
									echo $this->Html->link("<i class='icon-unlock'></i> Change Password",

									 array('plugin' => 'usermgmt','controller'=>'Users', 'action'=>'changeUserPassword', $row['User']['id'], 'page'=>$page), 
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
										
									    array('plugin' => 'usermgmt','controller'=>'Users', 'action'=>'viewUserPermissions', $row['User']['id'], 'page'=>$page), array('escape'=>false));
                                    echo"</li>";
                                    echo"<li>";
									echo $this->Html->link("<i class='icon-envelope-alt'></i> Send Email",

										array('plugin' => 'usermgmt','controller'=>'UserEmails', 'action'=>'sendToUser', $row['User']['id'], 'page'=>$page), array('escape'=>false));
									echo"</li>";
									echo"</div>";

								echo "</td>";
								#Control Panel Button - End

								echo "</tr>";
							}
						} else {
							echo "<tr><td colspan=10><br/><br/>".__('No Data')."</td></tr>";
						} ?>
					</tbody>
				</table>
				<?php echo $this->element('trader.dashboard.pagination'); ?>
			</div>
		</div>
	</div>
</div>