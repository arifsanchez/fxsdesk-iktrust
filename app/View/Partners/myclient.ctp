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
		<div class="box box-color blue box-bordered" id="updateNetworklisting">
			<div class="box-title">
				<h3>
					Clientele
				</h3>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-bordered usertable">
					<?php if(!empty($MT_ACC)){ ;?>
					<thead>
						<tr>
							<th>Account Number</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Country</th>
							<th>Operations</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($MT_ACC as $acc): ?>
						<tr>
							<td>
								<a class="btn btn-mini btn-blue" href="#" >
									<?php echo $acc['Mt4User']['NAME'];?>
								</a>
							</td>
							<td><?php echo $acc['Mt4User']['EMAIL'];?></td>
							<td><?php echo $acc['Mt4User']['PHONE'];?></td>
							<td><?php echo $acc['Mt4User']['COUNTRY'];?></td>
							<td>

								<a href="#popup-coming-soon" class="btn btn-mini btn-satblue" rel="tooltip" title="Email Client" data-toggle="modal"><i class="icon-envelope-alt"></i> Sent Email</a>

								<a href="#popup-coming-soon" class="btn btn-mini btn-green" rel="tooltip" title="Deposit to client wallet" data-toggle="modal"><i class="icon-money"></i> Transfer IK$</a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
					<?php } else { 
						echo "<tr><td>Congratulations on your partner account opening. Please proceed acquiring a new client trading account.</tr></td>";
					};?>
				</table>
				<?php echo $this->element('trader.dashboard.pagination'); ?>
			</div>
		</div>
	</div>
</div>