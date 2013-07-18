<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>

<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('User Detail') ?>
		</span>
		<?php $page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1; ?>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Back', true), array('action'=>'index', 'page'=>$page));?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Edit', true), array('action'=>'editUser', $userId, 'page'=>$page));?>
		</span>
	</div>
	<div class="um-panel-content">
		<div class="row">
			<div class="span3">
			<?php if (!empty($user)) { ?>
				<div class="left" style="height:100%; margin:5px">
					<div class="profile">
						<img alt="<?php echo h($user['User']['first_name'].' '.$user['User']['last_name']); ?>" src="<?php echo $this->Image->resize('img/'.IMG_DIR, $user['UserDetail']['photo'], 250, null, true) ?>">
					</div>
				</div>
			<?php } ?>
			</div>
			<div class="span6">
			<?php if (!empty($user)) { ?>
				<table class="table table-striped table-bordered">
					<tbody>
						<tr>
							<td><strong><?php echo __('Group(s)');?></strong></td>
							<td><?php echo h($user['UserGroup']['name'])?></td>
						</tr>
						<tr>
							<td><strong><?php echo __('Username');?></strong></td>
							<td><?php echo h($user['User']['username'])?></td>
						</tr>
						<tr>
							<td><strong><?php echo __('First Name');?></strong></td>
							<td><?php echo h($user['User']['first_name'])?></td>
						</tr>
						<tr>
							<td><strong><?php echo __('Last Name');?></strong></td>
							<td><?php echo h($user['User']['last_name'])?></td>
						</tr>
						<tr>
							<td><strong><?php echo __('Email');?></strong></td>
							<td><?php echo h($user['User']['email'])?></td>
						</tr>
						<tr>
							<td><strong><?php echo __('Gender');?></strong></td>
							<td><?php echo h(ucwords($user['UserDetail']['gender']))?></td>
						</tr>
						<tr>
							<td><strong><?php echo __('Marital Status');?></strong></td>
							<td><?php echo h(ucwords($user['UserDetail']['marital_status']))?></td>
						</tr>
						<tr>
							<td><strong><?php echo __('Birthday');?></strong></td>
							<td><?php if(!empty($user['UserDetail']['bday'])) { echo date('d-M-Y',strtotime($user['UserDetail']['bday'])); } ?></td>
						</tr>
						<tr>
							<td><strong><?php echo __('Cellphone');?></strong></td>
							<td><?php echo h($user['UserDetail']['cellphone'])?></td>
						</tr>
						<tr>
							<td><strong><?php echo __('Location');?></strong></td>
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
							<td><strong><?php echo __('By Admin');?></strong></td>
							<td><?php
									if ($user['User']['by_admin']) {
										echo __('Yes');
									} else {
										echo __('No');
									}
								?>
							</td>
						</tr>
						<tr>
							<td><strong><?php echo __('Email Verified');?></strong></td>
							<td><?php
									if ($user['User']['email_verified']) {
										echo __('Yes');
									} else {
										echo __('No');
									}
								?>
							</td>
						</tr>
						<tr>
							<td><strong><?php echo __('Ip Address');?></strong></td>
							<td><?php echo h($user['User']['ip_address'])?></td>
						</tr>
						<tr>
							<td><strong><?php echo __('Joined');?></strong></td>
							<td><?php echo date('d-M-Y',strtotime($user['User']['created']))?></td>
						</tr>
						<tr>
							<td><strong><?php echo __('Last Login');?></strong></td>
							<td><?php if(!empty($user['User']['last_login'])) { echo date('d-M-Y',strtotime($user['User']['last_login'])); }?></td>
						</tr>
					</tbody>
				</table>
			<?php } ?>
			</div>
		</div>
	</div>
</div>