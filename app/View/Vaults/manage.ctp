<?php echo $this->element('popup.feature.comingsoon');?>

<div class="row-fluid">
	<div class="span6">
		<div class="box box-color satblue box-small box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-money"></i>
					Wallet Balance
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
		<div class="box box-bordered">
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
						<?php endforeach; ?>
					</tbody>
					<?php } else {
						echo "<table class='table table-nomargin table-condensed'>";
						echo "<tr><td>Congratulations on your trader dashboard account opening. <br/>Open a new live trading account now.<br/><div class='pull-right'><a href='#popup-coming-soon' class='btn btn-lightred' data-toggle='modal' title='Register Live Account'><i class='icon-fire'></i> Open Live Account</a></div></tr></td>";
					};?>
				</table>
			</div>
		</div>
	</div>
</div>