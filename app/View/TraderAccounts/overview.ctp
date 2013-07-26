<?php

	#debug($MT_ACC);
	#debug($MT_TRANSACT);
?>

<div class="row-fluid">
	<div class="span6">
		<div class="box box-color green box-small box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-money"></i>
					Balance
				</h3>
			</div>
			<div class="box-content">

				<div class="row-fluid">
					<div class="span8">
						<center>
							<h1>US$ <?php echo number_format($MT_ACC['Mt4User']['BALANCE'], 2, '.', '');?></h1>
						</center>
						<hr/>
						<button class="btn-block btn btn-darkblue btn-large">Manage Funds</button>
					</div>

					<div class="span4">
						<center>
							<h1>CR$ <?php echo number_format($MT_ACC['Mt4User']['CREDIT'], 2, '.', '');?></h1>
						</center>
						<hr/>
						<button class="btn-block btn btn-teal btn-large">Request Credit</button>
					</div>
				</div>
			</div>
		</div>

		<div class="box box-color orange box-condensed box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-reorder"></i>
					Latest Account Transactions
				</h3>
			</div>
			<div class="box-content">
				<table class="table table-hover table-nomargin">
					<thead>
						<tr>
							<th>Deal #</th>
							<th>Transactions</th>
							<th>Confirmation Time</th>
							<th>Amount US$</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($MT_TRANSACT as $Transaction): ?>
						<tr>
							<td>
								<?php echo $Transaction['Mt4Trade']['TICKET'];?>

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
										echo "<span class=\"label label-brown	\">Credit</span>";
										break;
									};
								?>
							</td>
							<td><?php echo $Transaction['Mt4Trade']['CLOSE_TIME'];?></td>
							<td><div class="text-right"><?php echo number_format($Transaction['Mt4Trade']['PROFIT'], 2, '.', '');?></div></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="span6">
		<?php

			#debug($MT_ACC);
			#debug($MT_TRANSACT);
		?>
		<div class="box box-color red box-small box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-money"></i>
					Statistics
				</h3>
			</div>
			<div class="box-content">

				<div class="row-fluid">
					<div class="span4">
						<p class="align-center">
							<h1>US$ <?php echo number_format($MT_ACC['Mt4User']['BALANCE'], 2, '.', '');?></h1>
							<hr/>
							<h4>Total Deposit</h4>
						</p>
					</div>
					<div class="span4">
						<p class="align-center">
							<h1>US$ <?php echo number_format($MT_ACC['Mt4User']['BALANCE'], 2, '.', '');?></h1>
							<hr/>
							<h4>Total Withdrawal</h4>
						</p>
					</div>
					<div class="span4">
						<p class="align-center">
							<h1>US$ <?php echo number_format($MT_ACC['Mt4User']['BALANCE'], 2, '.', '');?></h1>
							<hr/>
							<h4>Profit / Loss</h4>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>