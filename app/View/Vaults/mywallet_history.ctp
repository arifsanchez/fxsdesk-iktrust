<?php 
	echo $this->element('popup.feature.comingsoon');

	if(!isset($updateDivId)) {
		$updateDivId="updateIndex";
	}
	$ajax=true;
	if(isset($useAjax) && !$useAjax) {
		$ajax=false;
	}
	if($ajax) {
		$this->Paginator->options(array(
			'update' => '#updateTradeHistory',
			'evalScripts' => true,
			'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
			'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false))
		));
	}
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color satgreen box-bordered" id="updateTradeHistory">
			<div class="box-title">
				<h3>
					Wallet Transaction History
				</h3>
				<div class="actions">
					<a href="<?php echo SITE_URL;?>Vaults/manage?me:<?php echo $var['User']['username'];?>" class="btn btn-mini" rel="tooltip" title="My Wallet Overview"><i class="icon-money"></i> Back to wallet overview</a>
				</div>
			</div>
			<div class="box-content nopadding">

				<table class="table table-hover table-nomargin table-condensed table-bordered">
					<thead>
						<?php if(empty($Wtransact)){ echo "<tr><blockquote>Your IK Wallet account is fresh without any transaction. Start your multi million journey by trading & earning great rewards today .</blockquote></tr>";} else {?> 
						<tr>
							<th>Reference Key</th>
							<th>Type</th>
							<th>Status</th>
							<th>Comment</th>
							<th><div class="text-right">Amount IK$</div></th>
							<th>Requested</th>
							<th><div class="text-right">Operations</div></th>
						</tr>
						<?php } ?>
					</thead>
					<tbody>
						<?php foreach($Wtransact as $Transaction): ?>
						<tr>
							<td>
								<button class="btn btn-info" data-placement="right" title="" rel="tooltip" data-original-title="<?php echo $Transaction['VaultTransaction']['description'];?>">
									<i class="icon-exclamation-sign"></i>
								</button>
								<?php
									$TRid = $Transaction['VaultTransaction']['id'];
									echo "WTRAN".$TRid;
								?>

							</td>
							
							<td>
								<?php
									$type = $Transaction['VaultTransaction']['type'];
									echo $this->element('requestVaultTransType', array('type' => $type));
								?>
							</td>
							<td>
								<?php
									$status = $Transaction['VaultTransaction']['status'];
									echo $this->element('requestVaultStatLabel', array('status' => $status));
								?>
							</td>
							<td><?php echo ucwords(strtolower($Transaction['VaultTransaction']['description']));?></td>
							<td><div class="text-right"><?php echo number_format($Transaction['VaultTransaction']['jumlah'], 2, '.', '');?></div></td>
							<td><span data-livestamp="<?php echo $Transaction['VaultTransaction']['created'];?>"></span></td>
							<td><a href="<?php echo SITE_URL;?>vaults/mywallet_transaction/process:<?php echo $TRid;?>" class="btn btn-mini btn-darkblue" rel="tooltip" title="TR<?php echo $Transaction['VaultTransaction']['id'];?>W  Transaction Details" data-toggle="modal"><i class="icon-cogs"></i> View Details</a></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php echo $this->element('trader.dashboard.pagination'); ?>
			</div>
		</div>
	</div>
</div>