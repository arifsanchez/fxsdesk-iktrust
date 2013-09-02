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
		<div class="box box-mini box-bordered" id="updateTradeHistory">
			<div class="box-title">
				<h3><?php echo strtoupper($filter);?> Transfer Request</h3>
				<div class="pull-right">
					FILTER BY STATUS: 
					&nbsp;
					<a
						data-original-title="New Transaction : Wallet to Trading Account Request" 
						rel="tooltip" 
						data-placement="bottom" 
						class="btn btn-orange" 
						href="<?php echo SITE_URL;?>Staffs/transfer_request/filter:new?me:<?php echo $var['User']['username'];?>" 
						title="" 
						data-toggle="modal" 
						data-trigger="hover"  
					>
						<i class="glyphicon-lightbulb"></i> NEW
					</a>
					&nbsp;
					<a
						data-original-title="Pending Transaction : Wallet to Trading Account Request" 
						rel="tooltip" 
						data-placement="bottom" 
						class="btn btn-satblue" 
						href="<?php echo SITE_URL;?>Staffs/transfer_request/filter:pending?me:<?php echo $var['User']['username'];?>" 
						title="" 
						data-toggle="modal" 
						data-trigger="hover"  
					>
						<i class="glyphicon-roundabout"></i> PENDING
					</a>
					&nbsp;
					<a
						data-original-title="Approved Transaction : Wallet to Trading Account Request" 
						data-placement="bottom" 
						class="btn btn-satgreen" 
						href="<?php echo SITE_URL;?>Staffs/transfer_request/filter:approve?me:<?php echo $var['User']['username'];?>" 
						title="" 
						data-toggle="modal" 
						data-trigger="hover"  
						rel="tooltip" 
					>
						<i class="glyphicon-ok_2"></i> APPROVED
					</a>
					&nbsp;
					<a
						data-original-title="Declined Transaction : Wallet to Trading Account Request" 
						data-placement="bottom" 
						class="btn btn-red" 
						href="<?php echo SITE_URL;?>Staffs/transfer_request/filter:decline?me:<?php echo $var['User']['username'];?>" 
						title="" 
						data-toggle="modal" 
						data-trigger="hover"  
						rel="tooltip" 
					>
						<i class="glyphicon-remove_2"></i> DECLINE
					</a>
					&nbsp;
				</div>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-condensed table-bordered">
					<thead>
						<tr>
							<th>Client Name</th>
							<th>Type</th>
							<th>Status</th>
							<th>Comment</th>
							<th><div class="text-right">Amount IK$</div></th>
							<th>Requested</th>
							<th>Operations</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							#debug($Wtransact); die();
							foreach($Wtransact as $Transaction): 
						?>
						<tr>
							<td>
								<button class="btn  btn-mini btn-info" data-placement="right" title="" rel="tooltip" data-original-title="<?php echo $Transaction['VaultTransaction']['description'];?>">
									<i class="icon-exclamation-sign"></i> <?php
									$TRid = $Transaction['VaultTransaction']['id'];
									echo "IKW".$TRid;
								?>
								</button>
								<?php
									$username = $Transaction['Vault']['User']['username'];
									echo $username;
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
							<td><div class="text-right"><?php echo $this->Number->Currency($Transaction['VaultTransaction']['jumlah'], '');?></div></td>
							<td><span data-livestamp="<?php echo $Transaction['VaultTransaction']['created'];?>"></span></td>
							<td><a href="<?php echo SITE_URL;?>Staffs/transfer_detail/process:<?php echo $TRid;?>?me:<?php echo $var['User']['username'];?>" class="btn btn-mini btn-darkblue" rel="tooltip" title="TR<?php echo $Transaction['VaultTransaction']['id'];?>W  Transaction Details" data-toggle="modal"><i class="icon-cogs"></i> View Details</a></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php echo $this->element('trader.dashboard.pagination'); ?>
			</div>
		</div>
	</div>
</div>