<?php 
	echo $this->element('popup.feature.comingsoon');
	echo $this->element('popup.deposit_partner', array('bal' => $acc1,'uname' => $var['User']['username'], 'uid' => $var['User']['id']));
	echo $this->element('popup.withdraw_partner', array('bal' => $acc1));
?>

<div class="row-fluid">
	<div class="span7">

		<div class="row-fluid">
			<div class="span6">
				<div class="box box-color satblue box-small box-bordered">
					<div class="box-title">
						<h3>
							<i class="icon-money"></i>
							IK$
						</h3>
						<div class="pull-right">
							<a
								data-original-title="Deposit to IK Wallet and transfer limitless to trading account." 
								rel="tooltip" 
								data-placement="bottom" 
								class="btn btn-satgreen" 
								href="#DepositWallet_partner" 
								title="" 
								data-toggle="modal" 
								data-trigger="hover"  
							>
								<i class="icon-plus-sign"></i>
							</a>
							&nbsp;
							<a
								data-original-title="The safest way to withdraw your IK Wallet fund. Select from many of our payment channel." 
								data-placement="bottom" 
								class="btn btn-red" 
								href="#WithdrawWallet_partner" 
								title="" 
								data-toggle="modal" 
								data-trigger="hover"  
								rel="tooltip" 
							>
								<i class="icon-minus-sign"></i>
							</a>
							&nbsp;
						</div>
					</div>
					<div class="box-content">
						<center>
							<h3><?php 
								if($acc1 == 0.00){
									echo "IK$ 0.00";
								} else {
									echo $this->Number->Currency($acc1, 'IK$ '); 
								}
							?></h3>
						</center>
					</div>
				</div>
			</div>
			<div class="span6">
				<div class="box box-color satblue box-small box-bordered">
					<div class="box-title">
						<h3>
							<i class="icon-money"></i>
							CR$
						</h3>
						<div class="pull-right">
							<a
								data-original-title="The safest way to withdraw your bonus. Select from many of our payment channel." 
								data-placement="bottom" 
								class="btn btn-red" 
								href="#popup-coming-soon" 
								title="" 
								data-toggle="modal" 
								data-trigger="hover"  
								rel="tooltip" 
							>
								<i class="icon-minus-sign"></i>
							</a>
							&nbsp;
						</div>
					</div>
					<div class="box-content">
						<center>
							<h3><?php 
								if($acc2 == 0.00){
									echo "CR$ 0.00";
								} else {
									echo $this->Number->Currency($acc2, 'CR$ '); 
								}
							?></h3>
						</center>
					</div>
				</div>
			</div>
		</div>

		<div class="box box-small box-bordered">
			<div class="box-title">
				<h3><i class="icon-reorder"></i> Wallet Transaction(s) </h3>
				<div class="pull-right">
					<a href="<?php echo SITE_URL;?>Partners/vault_history?me:<?php echo $var['User']['username'];?>" class="btn btn-color btn-satblue" data-toggle="modal" title="Register Live Account"><i class="icon-money"></i> View All History</a>
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
					<li>
						<a data-toggle="tab" href="#wal_decline"><i class="glyphicon-remove_2"></i> Declined</a>
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
											echo $this->element('requestVaultTransType', array('type' => $type));
										?>
									</td>
									<td>
										<?php
											$status = $vt_latest['VaultTransaction']['status'];
											echo $this->element('requestVaultStatLabel', array('status' => $status));
										?>
									</td>
									<td><div class="text-right"><?php echo $vt_latest['VaultTransaction']['jumlah'];?></div></td>
									<td><?php echo $this->Time->nice($vt_latest['VaultTransaction']['created']);?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
							<?php } else { echo "Congratulations on your fresh account. There is no transaction made yet ."; };
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
											echo $this->element('requestVaultTransType', array('type' => $type));
										?>
									</td>
									<td><?php echo $vt_new['VaultTransaction']['description'];?></td>
									<td><div class="text-right"><span class='label label-orange'><?php echo $vt_new['VaultTransaction']['jumlah'];?></span></div></td>
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
											echo $this->element('requestVaultTransType', array('type' => $type));
										?>
									</td>
									<td><?php echo $vt_pending['VaultTransaction']['description'];?></td>
									<td><div class="text-right"><span class='label label-satblue'><?php echo $vt_pending['VaultTransaction']['jumlah'];?></span></div></td>
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
											echo $this->element('requestVaultTransType', array('type' => $type));
										?>
									</td>
									<td><?php echo $vt_app['VaultTransaction']['description'];?></td>
									<td><div class="text-right"><span class='label label-satgreen'><?php echo $vt_app['VaultTransaction']['jumlah'];?></span></div></td>
									<td><?php echo $this->Time->nice($vt_app['VaultTransaction']['created']);?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
							<?php } else { echo "You have 0 <span class='label label-satgreen'>APPROVE</span> transaction request at this moment."; };
							?>
						</table>
					</div>
					<div id="wal_decline" class="tab-pane">
						<table class="table table-hover table-nomargin table-bordered usertable">
							<?php if(!empty($vtrans_decline)){ ;?>
							<thead>
								<tr>
									<th>Type</th>
									<th>Comment</th>
									<th>Total $</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($vtrans_decline as $vt_dec): ?>
								<tr>
									<td>
										<?php
											$type = $vt_dec['VaultTransaction']['type'];
											echo $this->element('requestVaultTransType', array('type' => $type));
										?>
									</td>
									<td><?php echo $vt_dec['VaultTransaction']['description'];?></td>
									<td><div class="text-right"><span class='label label-red'><?php echo $vt_dec['VaultTransaction']['jumlah'];?></span></div></td>
									<td><?php echo $this->Time->nice($vt_dec['VaultTransaction']['created']);?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
							<?php } else { echo "You have 0 <span class='label label-red'>DECLINE</span> transaction request at this moment."; };
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
								<a class="btn" href="<?php echo SITE_URL;?>Partners/history" >
									<?php echo $tradeAcc['Mt4User']['LOGIN'];?>
								</a>
							</td>
							<td><?php echo $this->Number->currency($tradeAcc['Mt4User']['BALANCE'], '$ ');?></td>
							<td>
								<a
									data-original-title="Add funds from IK Wallet"
									rel="tooltip"
									data-placement="bottom"
									class="btn btn-satgreen" 
									href="#DPpartnerAcc<?php echo $tradeAcc['Mt4User']['LOGIN'];?>"
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
									href="#WDpartnerAcc<?php echo $tradeAcc['Mt4User']['LOGIN'];?>"
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
							echo $this->element('popup.DPpartnerAcc', array('login' => $tradeAcc['Mt4User']['LOGIN'],'bal' => $acc1, 'balance' => $tradeAcc['Mt4User']['BALANCE']));
							echo $this->element('popup.WDpartnerAcc', array('login' => $tradeAcc['Mt4User']['LOGIN'],'bal' => $acc1, 'balance' => $tradeAcc['Mt4User']['BALANCE']));
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