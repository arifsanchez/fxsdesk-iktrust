<?php 
	echo $this->element('popup.feature.comingsoon');
	echo $this->element('popup.deposit', array('bal' => $acc1,'uname' => $var['User']['username'], 'uid' => $var['User']['id']));
	echo $this->element('popup.withdraw', array('bal' => $acc1));
?>

<div class="row-fluid">
	<div class="span6">
		<div class="box box-color satblue box-small box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-money"></i>
					Balance
				</h3>
				<div class="pull-right">
					<a
						data-original-title="Deposit to IK Wallet and transfer limitless to trading account." 
						rel="tooltip" 
						data-placement="bottom" 
						class="btn btn-satgreen" 
						href="#popup-coming-soon" 
						title="" 
						data-toggle="modal" 
						data-trigger="hover"  
					>
						<i class="icon-plus-sign"></i> DEPOSIT
					</a>
					&nbsp;
					<a
						data-original-title="The safest way to withdraw your IK Wallet fund. Select from many of our payment channel." 
						data-placement="bottom" 
						class="btn btn-red" 
						href="#popup-coming-soon" 
						title="" 
						data-toggle="modal" 
						data-trigger="hover"  
						rel="tooltip" 
					>
						<i class="icon-minus-sign"></i> WITHDRAW
					</a>
					&nbsp;
				</div>
			</div>
			<div class="box-content">

				<div class="row-fluid">
					<div class="span6">
						<center>
							<h3>IK$ <?php echo $this->Number->currency($acc1, 'IK$ '); ?></h3>
						</center>
					</div>
					<div class="span6">
						<center>
							<h3>CR$ <?php echo $acc2; ?></h3>
						</center>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="span6">
		<div class="box box-bordered box-color blue">
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					Partner Trading Account
				</h3>
			</div>
			<div class="box-content nopadding">
				<?php if(!empty($tradeAcc)){ ;?>
				<table class="table table-hover table-nomargin table-condensed">
					<thead>
						<tr>
							<th>Account Number</th>
							<th>Balance $</th>
							<th>Operations</th>
						</tr>
					</thead>
					<tbody>
						<?php #foreach($tradeAcc as $acc): ?>
						<tr>
							<td>
								<button class="btn btn-warning" data-placement="right" title="" rel="tooltip" data-original-title="<?php echo $tradeAcc['Mt4User']['NAME'];?>">
									<i class="icon-user-md"></i>
								</button>
								<a class="btn" href="<?php echo SITE_URL;?>#" >
									<?php echo $tradeAcc['Mt4User']['LOGIN'];?>
								</a>
							</td>
							<td><?php echo $this->Number->currency($tradeAcc['Mt4User']['BALANCE'], '$');?></td>
							<td>
								<a
									data-original-title="Add funds from IK Wallet"
									rel="tooltip"
									data-placement="bottom"
									class="btn btn-satgreen" 
									href="#popup-coming-soon"
									title="" 
									data-trigger="hover" 
									data-toggle="modal"	
								>
									<i class="icon-plus-sign"></i> 
								</a>
								&nbsp;
								<a
									data-original-title="Withdraw funds to IK Wallet"
									data-placement="bottom"
									class="btn btn-red" 
									href="#popup-coming-soon"
									title="" 
									data-trigger="hover" 
									data-toggle="modal" 
									rel="tooltip" 
								>
									<i class="icon-minus-sign"></i> 
								</a>
								&nbsp;
							</td>
						</tr>
						<?php
							#echo $this->element('popup.DPtradeAcc.wallet', array('login' => $tradeAcc['Mt4User']['LOGIN'],'bal' => $acc1, 'balance' => $tradeAcc['Mt4User']['BALANCE']));
							#echo $this->element('popup.WDtradeAcc.wallet', array('login' => $tradeAcc['Mt4User']['LOGIN'],'bal' => $acc1, 'balance' => $tradeAcc['Mt4User']['BALANCE']));
						?>
						<?php #endforeach; ?>
					</tbody>
					<?php } else {
						echo "<table class='table table-nomargin table-condensed'>";
						echo "<tr><td>You dont have any partner account in trading server. Please contact your account manager.</tr></td>";
					};?>
				</table>
			</div>
		</div>
		<div class="box box-bordered box-color orange">
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					Partner Commission Account
				</h3>
			</div>
			<div class="box-content nopadding">
				<?php if(!empty($tradeAcc)){ ;?>
				<table class="table table-hover table-nomargin table-condensed">
					<thead>
						<tr>
							<th>Account Number</th>
							<th>Balance $</th>
							<th>Operations</th>
						</tr>
					</thead>
					<tbody>
						<?php #foreach($tradeAcc as $acc): ?>
						<tr>
							<td>
								<button class="btn btn-warning" data-placement="right" title="" rel="tooltip" data-original-title="<?php echo $var['User']['username'];?>">
									<i class="icon-user-md"></i>
								</button>
								<a class="btn" href="#" data-placement="right" title="" rel="tooltip" data-original-title="Commission &amp; rewards account.">
									IK-PCA-<?php echo $var['User']['id'];?>
								</a>
								
							</td>
							<td>0.00</td>
							<td>
								<a
									data-original-title="Sell IK$ to other traders"
									data-placement="bottom"
									class="btn btn-red" 
									href="#popup-coming-soon"
									title="" 
									data-trigger="hover" 
									data-toggle="modal" 
									rel="tooltip" 
								>
									Sell @ MarketPlace
								</a>
								&nbsp;
							</td>
						</tr>
						<?php
							echo $this->element('popup.DPtradeAcc.wallet', array('login' => $tradeAcc['Mt4User']['LOGIN'],'bal' => $acc1, 'balance' => $tradeAcc['Mt4User']['BALANCE']));
							echo $this->element('popup.WDtradeAcc.wallet', array('login' => $tradeAcc['Mt4User']['LOGIN'],'bal' => $acc1, 'balance' => $tradeAcc['Mt4User']['BALANCE']));
						?>
						<?php #endforeach; ?>
					</tbody>
					<?php } else {
						echo "<table class='table table-nomargin table-condensed'>";
						echo "<tr><td>You dont have any partner account in trading server. Please contact your account manager.</tr></td>";
					};?>
				</table>
			</div>
		</div>
	</div>
</div>

<?php #debug($var['User']['username']); ?>