<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-small lightred box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="glyphicon-vcard"></i>
					My Profile
				</h3>
				<div class="actions">
					<button data-placement="bottom" rel="tooltip" data-original-title="Last update : <?php echo $var['User']['modified'];?>" class="btn btn-mini"><i class="icon-exclamation-sign"></i></button>
					<a href="<?php echo SITE_URL;?>editProfile" class="btn btn-mini"><i class="icon-cog"></i> Update My profile</a>
				</div>
			</div>
			<div class="box-content">

				<div class="row-fluid">
					<div class="span3">
						<?php if (!empty($user)) { ?>
							<img alt="<?php echo h($user['User']['first_name'].' '.$user['User']['last_name']); ?>" src="<?php echo $this->Image->resize('img/'.IMG_DIR, $user['UserDetail']['photo'], 250, null, true) ?>">
						<?php } ?>
					</div>
					<div class="span8">
						<?php if (!empty($user)) { ?>
							<table class="table table-striped table-bordered nopadding">
								<thead>
									<th>Remark</th>
									<th>Details</th>
									<th>Info</th>
								</thead>
								<tbody>
									<!--tr>
										<td><strong><?php echo __('Group(s)');?></strong></td>
										<td><?php echo h($user['UserGroup']['name'])?></td>
									</tr-->
									<tr>
										<td><strong><?php echo __('Username');?></strong></td>
										<td><?php echo h($user['User']['username'])?></td>
										<td>
											<button data-placement="bottom" rel="tooltip" data-original-title="Access ID for trader dashboard login. You cannot change the username." class="btn btn-mini btn-red"><i class="icon-lock"></i></button>
										</td>
									</tr>
									
									<tr>
										<td><strong><?php echo __('Email');?></strong></td>
										<td><?php echo h($user['User']['email'])?></td>
										<td><button data-placement="bottom" rel="tooltip" data-original-title="Access ID for trader dashboard login. You can change the email address." class="btn btn-mini btn-satgreen"><i class="icon-lock"></i></button></td>
									</tr>
									<tr>
										<td><strong><?php echo __('Full Name');?></strong></td>
										<td><?php echo h($user['User']['first_name']." ".$user['User']['last_name'])?></td>
										<td></td>
									</tr>
									<tr>
										<td><strong><?php echo __('Gender');?></strong></td>
										<td><?php echo h(ucwords($user['UserDetail']['gender']))?></td>
										<td></td>
									</tr>
									<tr>
										<td><strong><?php echo __('Birthday');?></strong></td>
										<td><?php if(!empty($user['UserDetail']['bday'])) { echo date('d-M-Y',strtotime($user['UserDetail']['bday'])); } ?></td>
										<td><button data-placement="bottom" rel="tooltip" data-original-title="IK Trust provide Special BONUS on your birthday every year." class="btn btn-mini btn-orange"><i class="icon-gift"></i></button></td>
									</tr>
									<tr>
										<td><strong><?php echo __('Mobile Phone');?></strong><span class="pull-right">

										</span></td>
										<td><?php echo h($user['UserDetail']['cellphone'])?></td>
										<td><button data-placement="bottom" rel="tooltip" data-original-title="Security PIN number will be sent to this registered mobile phone." class="btn btn-mini btn-lightred"><i class="icon-key"></i></button>
											<button data-placement="bottom" rel="tooltip" data-original-title="Notification / Alert regarding your trading account via SMS available." class="btn btn-mini btn-green"><i class="icon-rss"></i></button></td>
									</tr>
									<tr>
										<td><strong><?php echo __('Current City');?></strong></td>
										<td><?php echo h($user['UserDetail']['location'])?></td>
										<td></td>
									</tr>
									<tr>
										<td><strong><?php echo __('Web Page');?></strong></td>
										<td><?php echo h($user['UserDetail']['web_page'])?></td>
										<td></td>
									</tr>
									<tr>
										<td><strong><?php echo __('Profile Status');?></strong></td>
										<td>
											<?php
												if ($user['User']['active']) {
													#echo __('Dashboard Active');
													echo "<span class='label label-success'>Profile Verified</span>";
												} else {
													
													echo "<span class='label label-important'>Profile unVerified</span>";
												}
											?>
										</td>
										<td></td>
									</tr>
									<tr>
										<td><strong><?php echo __('IK Trader Since');?></strong></td>
										<td><?php echo date('d M Y',strtotime($user['User']['created']))?></td>
										<td></td>
									</tr>
								</tbody>
							</table>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>