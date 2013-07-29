<div class="row-fluid">
	<div class="span12">
		<div class="box box-color green box-small box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-money"></i>
					Trading Balance
				</h3>
			</div>
			<div class="box-content">

				<div class="row-fluid">
					<div class="span8">
						<center>
							<h3>US$ <?php echo number_format($MT_ACC['Mt4User']['BALANCE'], 2, '.', '');?></h3>
						</center>
						<hr/>
						<button class="btn-block btn btn-darkblue btn-large">Manage Funds</button>
					</div>

					<div class="span4">
						<dl>
							<dt>Trading Account Ownership</dt>
							<dd>
								<?php echo $MT_ACC['Mt4User']['NAME'];?>
							</dd>
							<dt>Leverage</dt>
							<dd>
								1:<?php echo $MT_ACC['Mt4User']['LEVERAGE'];?>
							</dd>
							<dt>Introducer</dt>
							<dd>
								<?php echo $MT_ACC['Mt4User']['AGENT_ACCOUNT'];?>
							</dd>
						</dl>
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
							<th>Open Time<br/>CLose Time</th>
							<th>Transactions</th>
							<th>Open Price<br/>Close Price</th>
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
										echo "<span class=\"label label-brown	\">Credit</span>";
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
									<b><?php echo number_format($Transaction['Mt4Trade']['PROFIT'], 2, '.', '');?></b>
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