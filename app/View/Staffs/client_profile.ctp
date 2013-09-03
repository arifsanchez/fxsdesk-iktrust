
<div class="row-fluid">
	<div class="span6">
		<div class="box box-small box-color lightred box-bordered">
			<div class="box-title">
				<h3>
					<i class="glyphicon-vcard"></i>
					<?php echo h($user['User']['first_name']." ".$user['User']['last_name'])?>
				</h3>
				<div class="actions">
					<a href="<?php echo SITE_URL;?><?php echo $user['User']['username'];?>" class="btn btn-mini" rel="tooltip" title="<?php echo $user['User']['username'];?>"><i class="icon-user"></i> View Public Profile</a>
				</div>
			</div>
			<div class="box-content">

				<div class="row-fluid">
					<div class="span4">
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
								</thead>
								<tbody>
									<tr>
										<td><strong><?php echo __('Full Name');?></strong></td>
										<td><?php echo h($user['User']['first_name']." ".$user['User']['last_name'])?></td>

									</tr>
									<tr>
										<td><strong><?php echo __('Gender');?></strong></td>
										<td><?php echo h(ucwords($user['UserDetail']['gender']))?></td>
									</tr>
									<tr>
										<td><strong><?php echo __('Email');?></strong></td>
										<td><?php echo h($user['User']['email'])?></td>
									</tr>
									<tr>
										<td><strong><?php echo __('Phone Number');?></strong></td>
										<td><?php echo h($user['UserDetail']['cellphone'])?></td>
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

		<div class="box box-color satgreen box-small box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-money"></i>
					Wallet
				</h3>
				<div class="pull-right">
					<a
						data-original-title="Wallet Transaction History" 
						rel="tooltip" 
						data-placement="bottom" 
						class="btn btn-mini" 
						href="#" 
						title="" 
						data-toggle="modal" 
						data-trigger="hover"  
					>
						<i class="icon-cogs"></i> History
					</a>
					&nbsp;
				</div>
			</div>
			<div class="box-content">

				<div class="row-fluid">
					<div class="span6">
						<center>
							<h3><?php if($acc1 == 0){echo "IK$ 0.00";} else {echo $this->Number->currency($acc1, 'IK$ ');} ?></h3>
						</center>
					</div>
					<div class="span6">
						<center>
							<!--h3><?php echo $this->Number->currency($acc2, 'CR$ ');?></h3-->
							<h3>CR$ 0.00</h3>
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="span6">
		<div class="box box-bordered box-color blue">
			<?php if(!empty($tradeTracc)){ ;?>
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					Trading Account List
				</h3>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-condensed">
					<thead>
						<tr>
							<th>Account Number</th>
							<th>Balance $</th>
							<th>Credit $</th>
							<th>Introducer</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($tradeTracc as $acc): ?>
						<tr>
							<td>
								<button class="btn btn-mini btn-info" data-placement="right" title="" rel="tooltip" data-original-title="<?php echo $acc['Mt4User']['GROUP'];?>">
									<i class="icon-exclamation-sign"></i>
								</button>
								<a class="btn btn-mini" href="<?php echo SITE_URL;?>Staffs/tracc_history/process:<?php echo $acc['Mt4User']['LOGIN'];?>" >
									<?php echo $acc['Mt4User']['LOGIN'];?>
								</a>
							</td>
							<td><?php echo number_format($acc['Mt4User']['BALANCE'], 2, '.', '');?></td>
							<td><?php echo number_format($acc['Mt4User']['CREDIT'], 2, '.', '');?></td>
							<td><?php echo $acc['Mt4User']['AGENT_ACCOUNT'];?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<?php } ;?>
		</div>
		<div class="box box-bordered box-color lightgrey">
			<?php if(!empty($tradeAgacc)){ ;?>
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					Agent Account List
				</h3>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-condensed">
					<thead>
						<tr>
							<th>Account Number</th>
							<th>Balance $</th>
							<th>Introducer</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($tradeAgacc as $acc): ?>
						<tr>
							<td>
								<button class="btn btn-mini btn-info" data-placement="right" title="" rel="tooltip" data-original-title="<?php echo $acc['Mt4User']['GROUP'];?>">
									<i class="icon-exclamation-sign"></i>
								</button>
								<a class="btn btn-mini" href="<?php echo SITE_URL;?>Staffs/agent_history/process:<?php echo $acc['Mt4User']['LOGIN'];?>" >
									<?php echo $acc['Mt4User']['LOGIN'];?>
								</a>
							</td>
							<td><?php echo number_format($acc['Mt4User']['BALANCE'], 2, '.', '');?></td>
							<td><?php echo $acc['Mt4User']['AGENT_ACCOUNT'];?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<?php } ;?>
		</div>
	</div>
</div>