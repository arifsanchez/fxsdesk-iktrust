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
				<?php
					#debug($userDetail); die();
				?>
				<table class="table table-hover table-nomargin table-condensed table-bordered">
					<thead>
						<tr>
							<th>Name</th>
							<th>Total Deposit</th>
							<th>Total Withdrawal</th>
							<th>Total Transfer In</th>
							<th>Total Transfer Out</th>
						</tr>
					</thead>
					<tbody>
						<td>
							<img alt="<?php echo h($userDetail['User']['first_name'].' '.$userDetail['User']['last_name']); ?>" src="<?php echo $this->Image->resize('img/'.IMG_DIR, $userDetail['UserDetail']['photo'], 20, null, true) ?>">
							<?php echo h($userDetail['User']['first_name'].' '.$userDetail['User']['last_name']); ?>
						</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tbody>
				</table>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-condensed table-bordered">
					<thead>
						<tr>
							<th>Type</th>
							<th>Status</th>
							<th>Comment</th>
							<th><div class="text-center">Amount IK$</div></th>
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
							<td>
								<div class="text-center">
									<?php 
										$akaun1 = $Transaction['VaultTransaction']['jumlah'];
										if($akaun1 == 0.00){
											echo "$ 0.00";
										} else if($akaun1 < 1.00) {
											echo "$ ".money_format('%.2n', $akaun1);
										} else {
											echo $this->Number->Currency($akaun1, '$ '); 
										}
									?>
								</div>
							</td>
							<td><span data-livestamp="<?php echo $Transaction['VaultTransaction']['created'];?>"></span></td>
							<td><a href="<?php echo SITE_URL;?>Staffs/transfer_detail/process:<?php echo $Transaction['VaultTransaction']['id'];?>?me:<?php echo $var['User']['username'];?>" class="btn btn-mini btn-darkblue" rel="tooltip" title="TR<?php echo $Transaction['VaultTransaction']['id'];?>W  Transaction Details" data-toggle="modal"><i class="icon-cogs"></i> View Details</a></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php echo $this->element('trader.dashboard.pagination'); ?>
			</div>
		</div>
	</div>
</div>