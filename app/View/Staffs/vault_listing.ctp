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
		<div class="box box-color box-small grey box-bordered" id="updateNetworklisting">
			<div class="box-title">
				<div class="actions">
					<?php #echo $this->element('staff.carianTraccNo');?>
				</div>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-bordered usertable">
					<?php if(!empty($PRvault)){ ;?>
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
						<?php foreach($PRvault as $acc): ?>
						<tr>
							<td>
								<button class="btn btn-info" data-placement="right" title="" rel="tooltip" data-original-title="<?php echo $acc['User']['username'];?>">
									<i class="icon-exclamation-sign"></i>
								</button>
								<a class="btn" href="<?php echo SITE_URL;?>Staffs/client_profile/name:<?php echo $acc['User']['username'];?>/carian:<?php echo $acc['User']['id'];?>" data-placement="right" title="" rel="tooltip" data-original-title="<?php echo $acc['Vault']['user_id'];?>:<?php echo $acc['User']['username'];?>" >
									<?php echo $acc['User']['first_name']." ".$acc['User']['last_name'];?>
								</a>
							</td>
							<td><?php 
								$akaun1 = $acc['Vault']['acc_1'];
								if($akaun1 == 0.00){
									echo "IK$ 0.00";
								} else if($akaun1 < 1.00) {
									echo "IK$ ".money_format('%.2n', $akaun1);
								} else {
									echo $this->Number->Currency($akaun1, 'IK$ '); 
								}
								#echo $this->Number->currency($acc['Vault']['acc_1'], 'IK$ ');
							?></td>
							<td><?php 
								$akaun2 = $acc['Vault']['acc_2'];
								if($akaun2 == 0.00){
									echo "CR$ 0.00";
								} else if($akaun1 < 1.00) {
									echo "CR$ ".money_format('%.2n', $akaun2);
								} else {
									echo $this->Number->Currency($akaun2, 'CR$ '); 
								}
								#echo $this->Number->currency($acc['Vault']['acc_2'], 'CR$ ');
							?></td>
							<td><?php echo $acc['Vault']['modified'];?></td>
							<td><span data-livestamp="<?php echo $acc['Vault']['created'];?>"></span></td>
							<td>
								<a href="<?php echo SITE_URL;?>Staffs/wallet_statement/process:<?php echo $acc['Vault']['id'];?>" class="btn btn-grey" rel="tooltip" title="Vault Statement"><i class="glyphicon-table"></i> Statement</a>
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