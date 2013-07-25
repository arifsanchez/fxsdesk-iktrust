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
				<center>
					<h1>US$ <?php echo number_format($MT_ACC['Mt4User']['BALANCE'], 2, '.', '');?></h1>
				</center>
				<hr/>
				<button class="btn-block btn btn-darkblue btn-large">Manage Funds</button>
			</div>
		</div>
	</div>
	<div class="span6">
		<div class="box box-color orange box-condensed box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-reorder"></i>
					Latest 5 Transactions
				</h3>
			</div>
			<div class="box-content">
				<table class="table table-hover table-nomargin">
					<thead>
						<tr>
							<th>Deal #</th>
							<th>Type</th>
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

									switch ($type){
										case "0":
										echo "<span class=\"label label-red\">Sell (".$Transaction['Mt4Trade']['SYMBOL'].")</span>";
										break;
										case "1":
										echo "<span class=\"label label-blue\">Buy</span>";
										break;
										case "6":
										echo "<span class=\"label label-darkblue\">+ Balance</span>";
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

</div>