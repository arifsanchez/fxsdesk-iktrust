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
					<?php echo $this->element('staff.carianTraccNoInactive');?>
				</div>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-bordered usertable">
					<?php if(!empty($MT_ACC)){ ;?>
					<thead>
						<tr>
							<th>Account Number</th>
							<th>Name</th>
							<th>Email / Phone</th>
							<th>Balance $</th>
							<th>Trade Status</th>
							<th>Account Maturity</th>
							<th>Operations</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($MT_ACC as $acc): ?>
						<tr>
							<td>
								<a class="btn btn-mini" href="<?php echo SITE_URL;?>Staffs/tracc_history/process:<?php echo $acc['Mt4User']['LOGIN'];?>" >
									<?php echo $acc['Mt4User']['LOGIN'];?>
								</a>
							</td>
							<td><?php echo $acc['Mt4User']['NAME'];?></td>
							<td><?php echo $acc['Mt4User']['EMAIL'];?><br/>
								<?php echo $acc['Mt4User']['PHONE'];?></td>
							<td><?php echo $this->Number->currency($acc['Mt4User']['BALANCE'], '');?></td></td>
							<td>
								<?php 	
								$accstatus = $acc['Mt4User']['ENABLE'];

									switch ($accstatus){
										case "1":
										echo "<span class=\"label label-satgreen\">Active</span>";
										break;
										default:
										echo "<span class=\"label label-lightred\">Disable</span>";
									};
								?>
							</td>
							<td><?php echo $acc['Mt4User']['REGDATE'];?></td>
							<td>
								<a href="<?php echo SITE_URL;?>Staffs/tracc_history/process:<?php echo $acc['Mt4User']['LOGIN'];?>" class="btn btn-mini btn-grey" rel="tooltip" title="Transactions History"><i class="glyphicon-table"></i> Transactions</a>

								<a href="#popup-coming-soon" class="btn btn-mini btn-darkblue" rel="tooltip" title="Trading Account Setting" data-toggle="modal"><i class="icon-cogs"></i> Setting</a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
					<?php } else { 
						echo "<tr><td>Start promoting and acquire new clients.</tr></td>";
					};?>
				</table>
				<?php echo $this->element('trader.dashboard.pagination'); ?>
			</div>
		</div>
	</div>
</div>