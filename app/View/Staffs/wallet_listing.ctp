<?php echo $this->element('popup.feature.comingsoon');?>

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
				<div class="actions">
					<?php #echo $this->element('staff.carianTraccNo');?>
				</div>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-bordered usertable">
					<?php if(!empty($TRwallet)){ ;?>
					<thead>
						<tr>
							<th>Name</th>
							<th>Account 1</th>
							<th>Account 2</th>
							<th>Last Changed</th>
							<th>Creation</th>
							<th>Operations</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($TRwallet as $acc): ?>
						<tr>
							<td>
								<button class="btn btn-info" data-placement="right" title="" rel="tooltip" data-original-title="<?php echo $acc['User']['username'];?>">
									<i class="icon-exclamation-sign"></i>
								</button>
								<a class="btn" href="<?php echo SITE_URL;?>Staffs/client_profile/name:<?php echo $acc['User']['username'];?>/carian:<?php echo $acc['User']['id'];?>" data-placement="right" title="" rel="tooltip" data-original-title="<?php echo $acc['Vault']['user_id'];?>:<?php echo $acc['User']['username'];?>" >
									<?php echo $acc['User']['first_name']." ".$acc['User']['last_name'];?>
								</a>
							</td>
							<td><?php echo $this->Number->currency($acc['Vault']['acc_1'], 'IK$ ');?></td>
							<td><?php echo $this->Number->currency($acc['Vault']['acc_2'], 'CR$ ');?></td>
							<td><?php echo $acc['Vault']['modified'];?></td>
							<td><span data-livestamp="<?php echo $acc['Vault']['created'];?>"></span></td>
							<td>
								<a href="<?php echo SITE_URL;?>Staffs/wallet_statement/process:<?php echo $acc['Vault']['id'];?>" class="btn btn-grey" rel="tooltip" title="Wallet Statement"><i class="glyphicon-table"></i> Statement</a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
					<?php } else { 
						echo "<tr><td>Loss connectivity with Wallet Database server</tr></td>";
					};?>
				</table>
				<?php echo $this->element('trader.dashboard.pagination'); ?>
			</div>
		</div>
	</div>
</div>