<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-small lightred box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="glyphicon-vcard"></i>
					<?php echo h($user['User']['first_name']." ".$user['User']['last_name'])?>
				</h3>
			</div>
			<div class="box-content">

				<div class="row-fluid">
					<div class="span3">
						<?php if (!empty($user)) { ?>
							<img alt="<?php echo h($user['User']['first_name'].' '.$user['User']['last_name']); ?>" src="<?php echo $this->Image->resize('img/'.IMG_DIR, $user['UserDetail']['photo'], 250, null, true) ?>">
						<?php } ?>
					</div>
					<div class="span5">
						<?php if (!empty($user)) { ?>
							<table class="table table-striped table-bordered nopadding">
								<thead>
									<th>Remark</th>
									<th>Details</th>
								</thead>
								<tbody>
									<tr>
										<td><strong><?php echo __('Full Name');?></strong></td>
										<td><?php echo h($user['User']['first_name']." ".$user['User']['last_name'])?></td>

									</tr>
									<tr>
										<td><strong><?php echo __('IK Trader Since');?></strong></td>
										<td><?php echo date('d M Y',strtotime($user['User']['created']))?></td>
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