<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-small lightred box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-money"></i>
					My Profile
				</h3>
				<div class="actions">
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
							<table class="table table-striped table-bordered">
								<tbody>
									<!--tr>
										<td><strong><?php echo __('Group(s)');?></strong></td>
										<td><?php echo h($user['UserGroup']['name'])?></td>
									</tr-->
									<tr>
										<td><strong><?php echo __('Username');?></strong></td>
										<td><?php echo h($user['User']['username'])?></td>
									</tr>
									<tr>
										<td><strong><?php echo __('Full Name');?></strong></td>
										<td><?php echo h($user['User']['first_name']." ".$user['User']['last_name'])?></td>
									</tr>
									<tr>
										<td><strong><?php echo __('Email');?></strong></td>
										<td><?php echo h($user['User']['email'])?></td>
									</tr>
									<tr>
										<td><strong><?php echo __('Gender');?></strong></td>
										<td><?php echo h(ucwords($user['UserDetail']['gender']))?></td>
									</tr>
									<!--tr>
										<td><strong><?php echo __('Birthday');?></strong></td>
										<td><?php if(!empty($user['UserDetail']['bday'])) { echo date('d-M-Y',strtotime($user['UserDetail']['bday'])); } ?></td>
									</tr-->
									<tr>
										<td><strong><?php echo __('Mobile Phone');?></strong></td>
										<td><?php echo h($user['UserDetail']['cellphone'])?></td>
									</tr>
									<tr>
										<td><strong><?php echo __('Current City');?></strong></td>
										<td><?php echo h($user['UserDetail']['location'])?></td>
									</tr>
									<tr>
										<td><strong><?php echo __('Web Page');?></strong></td>
										<td><?php echo h($user['UserDetail']['web_page'])?></td>
									</tr>
									<tr>
										<td><strong><?php echo __('Status');?></strong></td>
										<td><?php
												if ($user['User']['active']) {
													echo __('Active');
												} else {
													echo __('Inactive');
												}
											?>
										</td>
									</tr>
									<tr>
										<td><strong><?php echo __('Joined');?></strong></td>
										<td><?php echo date('d-M-Y',strtotime($user['User']['created']))?></td>
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