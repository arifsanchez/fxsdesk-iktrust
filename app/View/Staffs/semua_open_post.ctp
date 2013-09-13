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
		<div class="box box-color grey box-bordered" id="updateTradeHistory">
			<div class="box-title">
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-condensed table-bordered">
					<thead>
						<?php 
							if(empty($openPost)){ 
								echo "<tr><blockquote>There is 0 Open Position at the moment.</blockquote></tr>";
							} else {?> 
						<tr>
							<th><?php echo $this->Paginator->sort('Mt4Trade.LOGIN', __('Post Info')); ?></th>
							<th>Transactions</th>
							<th>Open Time</th>
							<th>Open Price</th>
							<th><div class="text-right"><?php echo $this->Paginator->sort('Mt4Trade.PROFIT', __('Amount US$'));?></div></th>
						</tr>
						<?php } ?>
					</thead>
					<tbody>
						<?php foreach($openPost as $Transaction): ?>
						<tr>
							<td>
								<button class="btn btn-info" data-placement="right" title="" rel="tooltip" data-original-title="Ticket #<?php echo $Transaction['Mt4Trade']['TICKET'];?>">
									<i class="icon-exclamation-sign"></i>
								</button>
								<?php echo $Transaction['Mt4Trade']['LOGIN'];?>

							</td>
							
							<td>
								<?php

								$type = $Transaction['Mt4Trade']['CMD'];
								$lot = $Transaction['Mt4Trade']['VOLUME'] / 100;
								//	Order type: 0 - BUY, 1 - SELL, 2 - BUY LIMIT, 3 - SELL LIMIT, 4 - BUY STOP, 5 - SELL STOP, 6 - BALANCE, 7 - CREDIT
									switch ($type){
										case "0":
										echo "<span class=\"label label-green\">BUY</span>&nbsp;<span class=\"label label-magenta\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$lot." lot</span>";
										break;
										case "1":
										echo "<span class=\"label label-red\">SELL</span>&nbsp;<span class=\"label label-magenta\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$lot." lot</span>";
										break;
										case "2":
										echo "<span class=\"label label-green\">BUY LIMIT</span>&nbsp;<span class=\"label label-magenta\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$lot." lot</span>";
										break;
										case "3":
										echo "<span class=\"label label-red\">SELL LIMIT</span>&nbsp;<span class=\"label label-magenta\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$lot." lot</span>";
										break;
										case "4":
										echo "<span class=\"label label-green\">BUY STOP</span>&nbsp;<span class=\"label label-magenta\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$Transaction['Mt4Trade']['COMMENT']."</span>";
										break;
										case "5":
										echo "<span class=\"label label-red\">SELL STOP</span>&nbsp;<span class=\"label label-magenta\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$Transaction['Mt4Trade']['COMMENT']."</span>";
										break;
										case "6":
										echo "<span class=\"label label-blue\">[+] Balance</span>&nbsp;<span class=\"label label-magenta\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$Transaction['Mt4Trade']['COMMENT']."</span>";
										break;
										case "7":
										echo "<span class=\"label label-orange	\">IK Credit</span>";
										break;
										default:
										echo $type;
										break;
									};
								?>
							</td>
							<td>
								<?php echo $this->Time->nice($Transaction['Mt4Trade']['OPEN_TIME']);?>
							</td>
							<td>
								<?php
									echo $Transaction['Mt4Trade']['OPEN_PRICE'];
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