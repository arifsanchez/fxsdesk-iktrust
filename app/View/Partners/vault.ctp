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
	</div>
</div>

<?php #debug($var['User']['username']); ?>