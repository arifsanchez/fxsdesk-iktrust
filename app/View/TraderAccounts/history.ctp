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
			<div class="row-fluid">
				<div class="span12">
					<table class="table table-hover table-nomargin table-condensed table-bordered">
						<thead>
							<tr>
								<th>Account Name</th>
								<th>Total Floating Post</th>
								<th>Total Closed Post</th>
								<th>$ (Now)</th>
								<th>$ (Yesterday)</th>
								<th>Credit</th>
								<th>Equity</th>
								<th>Leverage</th>
							</tr>
						</thead>
						<tbody>
							<td>
								<?php 	
									echo $nama_trader;
								?>
							</td>
							<td><div class="text-center"><h4><?php echo $traderOpenPost; ?></h4></div></td>
							<td><div class="text-center"><h4><?php echo $traderClosePost; ?></h4></div></td>
							<td><div class="text-center">
								<span class="label label-red"><?php echo $this->Number->Currency($bakiAcc, 'IK$ ');?></span>
							</div></td>
							<td><div class="text-center">
								<span class="label label-red"><?php echo $this->Number->Currency($bakiSemalam, 'IK$ ');?></span>
							</div></td>
							<td><div class="text-center">
								<span class="label label-inverse"><?php echo $this->Number->Currency($bakiCR, 'CR$ ');?></span>
							</div></td>
							<td><div class="text-center">
								<span class="label label-magenta"><?php echo $this->Number->Currency($equity, '$ ');?></span>
							</div></td>
							<td>
								<span class="label label-lime"><?php echo "1:".$leverage;?></span>
							</td>
						</tbody>
					</table>
				</div>
			</div>
			<div class="box-title">
				<div class="actions">
					<a href="<?php echo SITE_URL;?>TraderAccounts/overview/acc:<?php echo $MT_ACC['Mt4User']['LOGIN'];?>" class="btn btn-mini" rel="tooltip" title="Trading Account Overview"><i class="icon-briefcase"></i> Back to account overview</a>
				</div>
			</div>
			<div class="box-content nopadding">

				<table class="table table-hover table-nomargin table-condensed table-bordered">
					<thead>
						<?php if(empty($MT_TRANSACT)){ echo "<tr><blockquote>Your trading account is fresh without any transaction. Start your trading today .</blockquote></tr>";} else {?> 
						<tr>
							<th>Deal #</th>
							<th>Open Time / Close Time</th>
							<th>Transactions</th>
							<th>Open Price / Close Price</th>
							<th><div class="text-right">Amount US$</div></th>
						</tr>
						<?php } ?>
					</thead>
					<tbody>
						<?php foreach($MT_TRANSACT as $Transaction): ?>
						<tr>
							<td>
								<?php echo $Transaction['Mt4Trade']['TICKET'];?>

							</td>
							<td>
								<?php echo $Transaction['Mt4Trade']['OPEN_TIME'];?>
								<br/>
								<?php echo $Transaction['Mt4Trade']['CLOSE_TIME'];?>
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
										echo "<span class=\"label label-blue\">Balance</span>&nbsp;<span class=\"label label-magenta\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$Transaction['Mt4Trade']['COMMENT']."</span>";
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
								<?php if($Transaction['Mt4Trade']['OPEN_PRICE'] == "0"){ ;?>
									&nbsp;
								<?php } else {
									echo $Transaction['Mt4Trade']['OPEN_PRICE'];
									echo "<br/>";
									echo $Transaction['Mt4Trade']['CLOSE_PRICE'];
								};?>
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