<?php 
	echo $this->element('popup.feature.comingsoon');
	echo $this->element('popup.deposit', array('bal' => $acc1));
	echo $this->element('popup.withdraw', array('bal' => $acc1));
?>

<div class="row-fluid">
	<div class="span7">
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
							<h3><?php echo $this->Number->currency($acc1, 'IK$ ');?></h3>
						</center>
					</div>
					<div class="span6">
						<center>
							<!--h3><?php echo $this->Number->currency($acc2, 'CR$ ');?></h3-->
							<h3>CR$ 0.00</h3>
						</center>
					</div>
				</div>
			</div>
		</div>
		<div class="box box-small box-bordered">
			<div class="box-title">
				<h3><i class="icon-reorder"></i> Wallet Transaction(s) </h3>
				<div class="pull-right">
					<a href="<?php echo SITE_URL;?>Vaults/mywallet_history?me:<?php echo $var['User']['username'];?>" class="btn btn-color btn-satblue" data-toggle="modal" title="Register Live Account"><i class="icon-money"></i> View All History</a>
					&nbsp;
				</div>
			</div>
			<div class="box-content nopadding">
				<ul class="tabs tabs-inline tabs-top">
					<li class="active">
						<a data-toggle="tab" href="#wal_latest"><i class="glyphicon-log_book"></i> Latest</a>
					</li>
					<li>
						<a data-toggle="tab" href="#wal_new"><i class="glyphicon-lightbulb"></i> New</a>
					</li>
					<li>
						<a data-toggle="tab" href="#wal_pending"><i class="glyphicon-roundabout"></i> Pending</a>
					</li>
					<li>
						<a data-toggle="tab" href="#wal_approve"><i class="glyphicon-ok_2"></i> Approved</a>
					</li>
				</ul>
				<div class="tab-content padding tab-content-inline tab-content-bottom">
					<div id="wal_latest" class="tab-pane active">
						<table class="table table-hover table-nomargin table-bordered usertable">
							<?php if(!empty($vtrans_latest)){ ;?>
							<thead>
								<tr>
									<th>Type</th>
									<th>Status</th>
									<th>Total $</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($vtrans_latest as $vt_latest): ?>
								<tr>
									<td>
										<?php
											$type = $vt_latest['VaultTransaction']['type'];

											switch ($type){
												case "1":
												echo "<span class='label label-satgreen'>DP <i class='glyphicon-right_arrow'></i> TRADING ACC</span>";
												break;
												case "2":
												echo "<span class='label label-satgreen'>DP -> WALLET</span>";
												break;
											};
										?>
									</td>
									<td>
										<?php
											$status = $vt_latest['VaultTransaction']['status'];
											
											switch ($status){
												case 1:
												echo "<span class='label label-orange'>NEW</span>";
												break;
												case 2:
												echo "<span class='label label-satblue'>PENDING</span>";
												break;
												case 3:
												echo "<span class='label label-satgreen'>APPROVE</span>";
												break;
											};
										?>
									</td>
									<td><div class="text-right"><?php echo $vt_latest['VaultTransaction']['jumlah'];?></div></td>
									<td><?php echo $this->Time->nice($vt_latest['VaultTransaction']['created']);?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
							<?php } else { echo "Conratulations on your fresh account. There is no transaction made yet ."; };
							?>
						</table>
					</div>
					<div id="wal_new" class="tab-pane">
						<table class="table table-hover table-nomargin table-bordered usertable">
							<?php if(!empty($vtrans_new)){ ;?>
							<thead>
								<tr>
									<th>Type</th>
									<th>Comment</th>
									<th>Total $</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($vtrans_new as $vt_new): ?>
								<tr>
									<td>
										<?php
											$type = $vt_new['VaultTransaction']['type'];

											switch ($type){
												case "1":
												echo "<span class='label label-satgreen'>DP <i class='glyphicon-right_arrow'></i> TRADING ACC</span>";
												break;
												case "2":
												echo "<span class='label label-satgreen'>DP -> WALLET</span>";
												break;
											};
										?>
									</td>
									<td><?php echo $vt_new['VaultTransaction']['description'];?></td>
									<td><div class="text-right"><?php echo $vt_new['VaultTransaction']['jumlah'];?></div></td>
									<td><?php echo $this->Time->nice($vt_new['VaultTransaction']['created']);?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
							<?php } else { echo "You have 0 <span class='label label-orange'>NEW</span> transaction request at this moment."; };
							?>
						</table>
					</div>
					<div id="wal_pending" class="tab-pane">
						<table class="table table-hover table-nomargin table-bordered usertable">
							<?php if(!empty($vtrans_pending)){ ;?>
							<thead>
								<tr>
									<th>Type</th>
									<th>Comment</th>
									<th>Total $</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($vtrans_pending as $vt_pending): ?>
								<tr>
									<td>
										<?php
											$type = $vt_pending['VaultTransaction']['type'];

											switch ($type){
												case "1":
												echo "<span class='label label-satgreen'>DP <i class='glyphicon-right_arrow'></i> TRADING ACC</span>";
												break;
												case "2":
												echo "<span class='label label-satgreen'>DP -> WALLET</span>";
												break;
											};
										?>
									</td>
									<td><?php echo $vt_pending['VaultTransaction']['description'];?></td>
									<td><div class="text-right"><?php echo $vt_pending['VaultTransaction']['jumlah'];?></div></td>
									<td><?php echo $this->Time->nice($vt_pending['VaultTransaction']['created']);?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
							<?php } else { echo "You have 0 <span class='label label-satblue'>PROCESSING</span> transaction request at this moment."; };
							?>
						</table>
					</div>
					<div id="wal_approve" class="tab-pane">
						<table class="table table-hover table-nomargin table-bordered usertable">
							<?php if(!empty($vtrans_approve)){ ;?>
							<thead>
								<tr>
									<th>Type</th>
									<th>Comment</th>
									<th>Total $</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($vtrans_approve as $vt_app): ?>
								<tr>
									<td>
										<?php
											$type = $vt_app['VaultTransaction']['type'];

											switch ($type){
												case "1":
												echo "<span class='label label-satgreen'>DP <i class='glyphicon-right_arrow'></i> TRADING ACC</span>";
												break;
												case "2":
												echo "<span class='label label-satgreen'>DP -> WALLET</span>";
												break;
											};
										?>
									</td>
									<td><?php echo $vt_app['VaultTransaction']['description'];?></td>
									<td><div class="text-right"><?php echo $vt_app['VaultTransaction']['jumlah'];?></div></td>
									<td><?php echo $this->Time->nice($vt_app['VaultTransaction']['created']);?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
							<?php } else { echo "You have 0 <span class='label label-satgreen'>APPROVE</span> transaction request at this moment."; };
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="span5">
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
							echo $this->element('popup.DPtradeAcc.wallet', array('login' => $acc['Mt4User']['LOGIN'],'bal' => $acc1, 'traccbal' => $acc['Mt4User']['BALANCE']));
							echo $this->element('popup.WDtradeAcc.wallet', array('login' => $acc['Mt4User']['LOGIN'],'bal' => $acc1, 'traccbal' => $acc['Mt4User']['BALANCE']));
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
	</div>
</div>

<?php #debug($var['User']['username']); ?>