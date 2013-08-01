<?php 
	echo $this->element('popup.feature.comingsoon');
	echo $this->element('popup.DPtradeAcc', array('login' => $MT_ACC['Mt4User']['LOGIN'], 'balance' => $MT_ACC['Mt4User']['BALANCE']));
	echo $this->element('popup.WDtradeAcc', array('login' => $MT_ACC['Mt4User']['LOGIN'], 'balance' => $MT_ACC['Mt4User']['BALANCE']));
?>

<div class="row-fluid">
	<div class="span7">
		<div class="box box-color green box-small box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-money"></i>
					Trading Account Balance
				</h3>
			</div>
			<div class="box-content">

				<div class="row-fluid">
					<div class="span7">
						<center>
							<h2>US$ <?php echo number_format($MT_ACC['Mt4User']['BALANCE'], 2, '.', '');?></h2>
						</center>
					</div>

					<div class="span5">
						<a
							data-original-title="Transfer From IK Wallet"
							data-content="The fastest way to fund your trading accounts. Easily transfer from your IK Wallet to selected trading account."
							data-placement="top"
							class="btn-block btn btn-satgreen" 
							href="#DPtradeAcc"
							title="" 
							data-trigger="hover"
							data-toggle="modal"
							rel="popover"
						>
							Trading Account&nbsp;
							<i class="icon-circle-arrow-left"></i>&nbsp;
							Wallet
						</a>
						<br/>
						<a
							data-original-title="Withdraw to IK Wallet"
							data-content="The safest way to withdraw your trading accounts. Easily transfer from your trading account to IK Wallet ."
							data-placement="bottom"
							class="btn-block btn btn-red" 
							href="#WDtradeAcc"
							title="" 
							data-trigger="hover" 
							data-toggle="modal"
							rel="popover"
						>
							Trading Account&nbsp;
							<i class="icon-circle-arrow-right"></i>&nbsp;
							Wallet
						</a>
				
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="span5">
		<div class="box box-small">
			<div class="box-title">
				<h3>
					<i class="icon-tasks"></i>
					Trading Account Tools
				</h3>
			</div>
			<div class="box-content">

				<a href="<?php echo SITE_URL;?>TraderAccounts/history/acc:<?php echo $MT_ACC['Mt4User']['LOGIN'];?>" class="btn btn-large btn-grey" rel="tooltip" title="Transactions History"><i class="glyphicon-table"></i> Transactions</a>

				<a href="#popup-coming-soon" class="btn btn-large btn-darkblue" rel="tooltip" title="Trading Account Setting" data-toggle="modal"><i class="icon-cogs"></i> Setting</a>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-color grey box-small box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-reorder"></i>
					Latest Account Transactions
				</h3>
				<div class="actions">
					<a href="<?php echo SITE_URL;?>TraderAccounts/history/acc:<?php echo $MT_ACC['Mt4User']['LOGIN'];?>" class="btn btn-mini"><i class="glyphicon-table"></i> View All Transactions</a>
				</div>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-condensed table-bordered">
					<thead>
						<tr>
							<th>Deal #</th>
							<th>Open Time / Close Time</th>
							<th>Transactions</th>
							<th>Open Price / Close Price</th>
							<th><div class="text-right">Amount US$&nbsp;</div></th>
						</tr>
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

									switch ($type){
										case "0":
										echo "<span class=\"label label-red\">SELL</span>&nbsp;<span class=\"label label-satgreen\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$lot." lot</span>";
										break;
										case "1":
										echo "<span class=\"label label-green\">BUY</span>&nbsp;<span class=\"label label-satgreen\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$lot." lot</span>";
										break;
										case "5":
										echo "<span class=\"label label-red\">[-] Balance</span>&nbsp;<span class=\"label label-satgreen\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$Transaction['Mt4Trade']['COMMENT']."</span>";
										break;
										case "6":
										echo "<span class=\"label label-blue\">[+] Balance</span>&nbsp;<span class=\"label label-satgreen\">".$Transaction['Mt4Trade']['SYMBOL']."</span>&nbsp;<span class=\"label label-lightgrey\">".$Transaction['Mt4Trade']['COMMENT']."</span>";
										break;
										case "7":
										echo "<span class=\"label label-orange	\">IK Credit</span>";
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
									<b><?php
										$jumlah = number_format($Transaction['Mt4Trade']['PROFIT'], 2, '.', '');
										if(strpos($jumlah,'-') === FALSE){
											echo $jumlah;
										} else {
											echo "<span style='color:red'>".$jumlah."</span>";
										}
									;?>&nbsp;</b>
								</div>
							</td>
							
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<div>
		<?php

			#debug($MT_ACC);
			#debug($MT_TRANSACT);
		?>
		</div>
	</div>
</div>