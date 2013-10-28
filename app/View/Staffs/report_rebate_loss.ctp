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
		'update' => '#updateTradeHistory',
		'evalScripts' => true,
		'before' => $this->Js->get('#busy-indicator')->effect('fadeIn', array('buffer' => false)),
		'complete' => $this->Js->get('#busy-indicator')->effect('fadeOut', array('buffer' => false))
	));
}
?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-color satblue box-bordered" id="updateTradeHistory">
			<table class="table table-hover table-nomargin table-condensed table-bordered">
				<thead>
					<tr>
						<th><div class="text-center">Total Today</div></th>
						<th><div class="text-center">Total Yesterday</div></th>
						<th><div class="text-center">Total Last Week</div></th>
						<th><div class="text-center">Total Last Month</div></th>
						<th><div class="text-center">Overall</div></th>
					</tr>
				</thead>
				<tbody>
					<td><div class="text-center"><h4><?php echo $this->Number->currency($TodayRebloss, 'IK$ '); ?><br/><small><?php echo $this->Number->currency($TodayRebloss*3.3, 'RM '); ?></small></h4></div></td>
					<td><div class="text-center"><h4><?php echo $this->Number->currency($YesterdayRebloss, 'IK$ '); ?><br/><small><?php echo $this->Number->currency($YesterdayRebloss*3.3, 'RM '); ?></small></h4></div></td>
					<td><div class="text-center"><h4><?php echo $this->Number->currency($LastWeekRebloss, 'IK$ '); ?><br/><small><?php echo $this->Number->currency($LastWeekRebloss*3.3, 'RM '); ?></small></h4></div></td>
					<td><div class="text-center"><h4><?php echo $this->Number->currency($LastMonthRebloss, 'IK$ '); ?><br/><small><?php echo $this->Number->currency($LastMonthRebloss*3.3, 'RM '); ?></small></h4></div></td>
					<td><div class="text-center"><h4><?php echo $this->Number->currency($OverallRebloss, 'IK$ '); ?><br/><small><?php echo $this->Number->currency($OverallRebloss*3.3, 'RM '); ?></small></h4></div></td>
				</tbody>
			</table>

			<div class="box-title">
				<div class="actions">
				</div>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-condensed table-bordered">
					<thead>
						<?php 
							if(empty($reportComm)){ 
								echo "<tr><blockquote>There is 0 Transaction History at the moment.</blockquote></tr>";
							} else {?> 
						<tr>
							<th><?php echo $this->Paginator->sort('Mt4Trade.TICKET', __('Post Info')); ?></th>
							<th>Tracc No</th>
							<th>Comment</th>
							<th>Date / Time</th>
							<th><div class="text-right">Amount US$</div></th>
						</tr>
						<?php } ?>
					</thead>
					<tbody>
						<?php foreach($reportComm as $Transaction): ?>
						<tr>
							<td>
								<?php echo $Transaction['Mt4Trade']['TICKET'];?>
							</td>

							<td>
								<span class="label label-warning"><?php echo $Transaction['Mt4Trade']['LOGIN'];?></span>
							</td>
							
							<td>
								<span class="label label-lightgrey"><?php echo $Transaction['Mt4Trade']['COMMENT'];?></span>
							</td>
							<td>
								<?php
									echo $this->Time->nice($Transaction['Mt4Trade']['OPEN_TIME']);
								;?>
							<td>
								<div class="text-right">
									<b>
									<?php 
										$jumlah = number_format($Transaction['Mt4Trade']['PROFIT'], 2, '.', '');
										if(strpos($jumlah,'-') === FALSE){
											echo $jumlah;
										} else {
											echo "<span style='color:red'>".$jumlah."</span>";
										}
									?>
									</b>
								</div>
							</td>
							
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php echo $this->element('trader.dashboard.pagination'); ?>
			</div>
		</div>
	</div>
</div>