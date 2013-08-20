<?php 
	echo $this->element('popup.feature.comingsoon');
	echo $this->element('popup.deposit', array('bal' => $acc1));
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
						href="#DepositWallet" 
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
						href="#WithdrawWallet" 
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
							<h3>IK$ <?php echo $acc1; ?></h3>
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
					Trading Account List
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
						<?php foreach($tradeAcc as $acc): ?>
						<tr>
							<td>
								<button class="btn btn-info" data-placement="right" title="" rel="tooltip" data-original-title="<?php echo $acc['Mt4User']['GROUP'];?>">
									<i class="icon-exclamation-sign"></i>
								</button>
								<a class="btn" href="<?php echo SITE_URL;?>TraderAccounts/overview/acc:<?php echo $acc['Mt4User']['LOGIN'];?>" >
									<?php echo $acc['Mt4User']['LOGIN'];?>
								</a>
							</td>
							<td><?php echo number_format($acc['Mt4User']['BALANCE'], 2, '.', '');?></td>
							<td>
								<a
									data-original-title="Add funds from IK Wallet"
									rel="tooltip"
									data-placement="bottom"
									class="btn btn-satgreen" 
									href="#DPtradeAcc<?php echo $acc['Mt4User']['LOGIN'];?>"
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
									href="#WDtradeAcc<?php echo $acc['Mt4User']['LOGIN'];?>"
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
							echo $this->element('popup.DPtradeAcc.wallet', array('login' => $acc['Mt4User']['LOGIN'],'bal' => $acc1, 'balance' => $acc['Mt4User']['BALANCE']));
							echo $this->element('popup.WDtradeAcc.wallet', array('login' => $acc['Mt4User']['LOGIN'],'bal' => $acc1, 'balance' => $acc['Mt4User']['BALANCE']));
						?>
						<?php endforeach; ?>
					</tbody>
					<?php } else {
						echo "<table class='table table-nomargin table-condensed'>";
						echo "<tr><td>Congratulations on your trader dashboard account opening. <br/>Open a new live trading account now.<br/><div class='pull-right'><a href='#popup-coming-soon' class='btn btn-lightred' data-toggle='modal' title='Register Live Account'><i class='icon-fire'></i> Open Live Account</a></div></tr></td>";
					};?>
				</table>
			</div>
		</div>
		<!--div class="box box-bordered box-color orange">
			<div class="box-title">
				<h3>
					<i class="icon-table"></i>
					IK Investment Account
				</h3>
			</div>
			<div class="box-content nopadding">
				<?php if(!empty($investAcc)){ ;?>
				<table class="table table-hover table-nomargin table-condensed">
					<thead>
						<tr>
							<th>Account Number</th>
							<th>Balance $</th>
							<th>Operations</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($investAcc as $vest): ?>
						<tr>
							<td>
								<button class="btn btn-info" data-placement="right" title="" rel="tooltip" data-original-title="<?php echo $vest['Mt4User']['GROUP'];?>">
									<i class="icon-exclamation-sign"></i>
								</button>
								<a class="btn" href="<?php echo SITE_URL;?>TraderAccounts/overview/vest:<?php echo $vest['Mt4User']['LOGIN'];?>" >
									<?php echo $vest['Mt4User']['LOGIN'];?>
								</a>
							</td>
							<td><?php echo number_format($vest['Mt4User']['BALANCE'], 2, '.', '');?></td>
							<td>
								<a
									data-original-title="Add funds from IK Wallet"
									rel="tooltip"
									data-placement="bottom"
									class="btn btn-satgreen" 
									href="#DPtradeAcc<?php echo $vest['Mt4User']['LOGIN'];?>"
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
									href="#WDtradeAcc<?php echo $acc['Mt4User']['LOGIN'];?>"
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
							echo $this->element('popup.DPtradeAcc.wallet', array('login' => $vest['Mt4User']['LOGIN'],'bal' => $acc1, 'balance' => $vest['Mt4User']['BALANCE']));
							echo $this->element('popup.WDtradeAcc.wallet', array('login' => $acc['Mt4User']['LOGIN'],'bal' => $acc1, 'balance' => $vest['Mt4User']['BALANCE']));
						?>
						<?php endforeach; ?>
					</tbody>
					<?php } else {
						echo "<table class='table table-nomargin table-condensed'>";
						echo "<tr><td>IK Investment offer long term investment with return starting at 10% per year. Minimum capital $10 and up to $1000<br/><div class='pull-right'><a href='#popup-coming-soon' class='btn btn-lightred' data-toggle='modal' title='Read More Info'><i class='icon-fire'></i> Read More Info</a></div></tr></td>";
					};?>
				</table>
			</div-->
		</div>
	</div>
</div>

<?php #debug($var['User']['username']); ?>