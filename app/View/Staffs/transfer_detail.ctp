<?php 
	debug($TranDetails);
 	#debug($userDetails);
 ?>

<div class="row-fluid">
	<div class="span4">
		<div class="box box-color blue box-small box-bordered">
			<div class="box-title">
				<h3><i class="icon-user"></i> Client Details</h3>
			</div>
			<div class="box-content">
				<div class="row-fluid">
					<div class="span4">
						<img alt="<?php echo h($userDetails['User']['first_name'].' '.$userDetails['User']['last_name']); ?>" src="<?php echo $this->Image->resize('img/'.IMG_DIR, $userDetails['UserDetail']['photo'], 100, null, true) ?>">
					</div>
					<div class="span8">
						<b><?php echo h($userDetails['User']['first_name'].' '.$userDetails['User']['last_name']); ?></b>
						<p><i class="glyphicon-e-mail"></i> <?php echo h($userDetails['User']['email']);?></p>
						<span class="time">
							Registered on <?php echo h($userDetails['User']['created']); ?>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="span8">
		<!-- Transaction Details -->
		<div class="box box-color satblue box-small box-bordered nopadding">
			<div class="box-title">
				<h3><i class="icon-reorder"></i> Transaction Details</h3>
			</div>
			<div class="box-content">
				<!-- Type | Status | Amount | Source | Source balance-->
				<table class="table table-hover table-nomargin table-condensed table-bordered">
					<thead>
						<tr>
							<th>Type</th>
							<th>Status</th>
							<th>Amount</th>
							<th>Source</th>
							<th>Source Balance</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $TranDetails['VaultTransaction']['type'];?></td>
							<td><?php echo $TranDetails['VaultTransaction']['status'];?></td>
							<td><?php echo $TranDetails['VaultTransaction']['jumlah'];?></td>
							<td><?php echo $TranDetails['Vault']['id'];?></td>
							<td><?php echo $TranDetails['Vault']['acc_1'];?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<!-- Comments Details -->
		<div class="box box-small box-bordered">
			<div class="box-title">
				<h3><i class="icon-comments"></i> Transaction Comments</h3>
			</div>
			<div class="box-content">

			</div>
		</div>
	</div>
</div>