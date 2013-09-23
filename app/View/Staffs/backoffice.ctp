<?php 
	echo $this->element('popup.feature.comingsoon'); //call a href #popup-coming-soon
?>

<div class="row-fluid">
	<div class="span6">
		<!-- Servicing Traders -->
		<div class="box box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-th-large"></i>
					Traders
				</h3>
				<div class="actions">
					<?php echo $this->element('staff.carianClientEmail');?>
				</div>
			</div>
			<div class="box-content">
				<ul class="stats">
					<li class="blue">
						<a href="<?php echo SITE_URL;?>staffs/client_listing?me:<?php echo $var['User']['username'];?>">
							<i class="icon-user"></i>
							<div class="details">
								<span class="big"><?php $TotalRegClients = $this->requestAction('usermgmt/Users/kiraTotalClient') ; echo $TotalRegClients;?></span>
								<span>Clients</span>
							</div>
						</a>
					</li>
					<li class="satblue">
						<a href="<?php echo SITE_URL;?>Staffs/tracc_listing?me:<?php echo $var['User']['username'];?>">
							<i class="icon-user"></i>
							<div class="details">
								<span class="big"><?php $TotalTraders = $this->requestAction('TraderAccounts/kiraTotalTraders') ; echo $TotalTraders;?></span>
								<span>Accounts</span>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="span6">
		<!-- Servicing Partners -->
		<div class="box box-color red box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-th-large"></i>
					Partners
				</h3>
			</div>
			<div class="box-content">
				<ul class="stats">
					<li class="grey">
						<a href="<?php echo SITE_URL;?>Staffs/partner_listing?me:<?php echo $var['User']['username'];?>">
							<i class="icon-group"></i>
							<div class="details">
								<span class="big"><span class="big"><?php $TotalRegPartners = $this->requestAction('usermgmt/Users/kiraTotalPartner') ; echo $TotalRegPartners;?> Live</span></span>
								<span>Partners</span>
							</div>
						</a>
					</li>

					<li class="lightgrey">
						<a href="<?php echo SITE_URL;?>Staffs/agent_listing?me:<?php echo $var['User']['username'];?>">
							<i class="icon-group"></i>
							<div class="details">
								<span class="big"><span class="big"><?php $TotalRegAgents = $this->requestAction('TraderAccounts/kiraTotalAgent') ; echo $TotalRegAgents;?></span></span>
								<span>Agents</span>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span6">
		<div class="box box-color box-bordered magenta box-small">
			<div class="box-title">
				<h3>
					<i class="icon-th-large"></i>
					Finance Transfer Queue
				</h3>
			</div>
			<div class="box-content">
				<ul class="stats">
					<!--li class="satgreen">
						<a href="<?php echo SITE_URL;?>Staffs/deposit_request?me:<?php echo $var['User']['username'];?>"  rel="tooltip" data-placement="bottom" data-original-title="New Deposit Request">
							<i class="icon-money"></i>
							<div class="details">
								<span class="big">xx</span>
								<span>Deposit</span>
							</div>
						</a>
					</li>

					<li class="red">
						<a href="<?php echo SITE_URL;?>Staffs/withdrawal_request?me:<?php echo $var['User']['username'];?>"  rel="tooltip" data-placement="top" data-original-title="New Withdrawal Request">
							<i class="icon-money"></i>
							<div class="details">
								<span class="big">xx</span>
								<span>Withdraw</span>
							</div>
						</a>
					</li-->

					<li class="orange">
						<a href="<?php echo SITE_URL;?>Staffs/transfer_request/filter:new?me:<?php echo $var['User']['username'];?>" rel="tooltip" data-placement="bottom" data-original-title="New Transfer Request">
							<i class="icon-money"></i>
							
							<div class="details">
								<span class="big"><?php $TotalTRW_TRACC = $this->requestAction('vaults/kiraTotalNewTRW_TRACC'); echo $TotalTRW_TRACC;?> </span>
								<span>NEW</span>
							</div>
						</a>
					</li>
					<li class="satblue">
						<a href="<?php echo SITE_URL;?>Staffs/transfer_request/filter:pending?me:<?php echo $var['User']['username'];?>" rel="tooltip" data-placement="bottom" data-original-title="Pending Transfer Request">
							<i class="icon-money"></i>
							<div class="details">
								<span class="big"><?php $TotalTRW_TRACC_pending = $this->requestAction('vaults/kiraTotalNewTRW_TRACC_code2'); echo $TotalTRW_TRACC_pending;?> </span>
								<span>PENDING</span>
							</div>
						</a>
					</li>
					<li class="green">
						<a href="<?php echo SITE_URL;?>Staffs/transfer_request/filter:approve?me:<?php echo $var['User']['username'];?>" rel="tooltip" data-placement="bottom" data-original-title="Approved Transfer Request">
							<i class="icon-money"></i>
							<div class="details">
								<span class="big"><?php $TotalTRW_TRACC_approve = $this->requestAction('vaults/kiraTotalNewTRW_TRACC_code3'); echo $TotalTRW_TRACC_approve;?> </span>
								<span>APPROVE</span>
							</div>
						</a>
					</li>
				</ul>				
			</div>
		</div>
	</div>

	<div class="span6">
		<!-- Market Watch -->
		<div class="box box-color magenta box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-th-large"></i>
					Finance Monitoring
				</h3>
			</div>
			<div class="box-content">
				<ul class="stats">
					<li class="blue">
						<a href="<?php echo SITE_URL;?>Staffs/wallet_listing?me:<?php echo $var['User']['username'];?>">
							<i class="icon-sitemap"></i>
							<div class="details">
								<span class="big"><span class="big"><?php $JumlahActiveWallets = $this->requestAction('Staffs/JumlahActiveWallets') ; echo $JumlahActiveWallets;?></span></span>
								<span>Client Wallets</span>
							</div>
						</a>
					</li>

					<li class="grey">
						<a href="<?php echo SITE_URL;?>Staffs/vault_listing?me:<?php echo $var['User']['username'];?>">
							<i class="icon-sitemap"></i>
							<div class="details">
								<span class="big"><span class="big"><?php $JumlahActiveVaults = $this->requestAction('Staffs/JumlahActiveVaults') ; echo $JumlahActiveVaults;?></span></span>
								<span>Partner Vaults</span>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span6">
		<!-- Market Watch -->
		<div class="box box-color lime box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-th-large"></i>
					Market Watch
				</h3>
			</div>
			<div class="box-content">
				<ul class="stats">
					<li class="red">
						<a href="<?php echo SITE_URL;?>Staffs/semua_open_post?me:<?php echo $var['User']['username'];?>">
							<i class="icon-spinner"></i>
							<div class="details">
								<span class="big"><span class="big"><?php $TotalOpenPost = $this->requestAction('Staffs/JumlahOpenPost') ; echo $TotalOpenPost;?></span></span>
								<span>Open Post</span>
							</div>
						</a>
					</li>

					<li class="lime">
						<a href="<?php echo SITE_URL;?>Staffs/report_close_order?me:<?php echo $var['User']['username'];?>">
							<i class="icon-spinner"></i>
							<div class="details">
								<?php $TotalClosePost = $this->requestAction('Staffs/JumlahClosePost') ;?>
								<span class="big"><span class="big"><?php echo $TotalClosePost;?></span></span>
								<span>Traded</span>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="span6">
		
	</div>
</div>

<div class="row-fluid">
	<div class="span6">
		<div class="box box-color box-bordered brown box-small">
			<div class="box-title">
				<h3>
					<i class="icon-th-large"></i>
					Traders Monitoring
				</h3>
			</div>
			<div class="box-content">
				<ul class="stats">
					<li class="grey">
						<a href="<?php echo SITE_URL;?>Staffs/report_rebate?me:<?php echo $var['User']['username'];?>">
							<i class="icon-money"></i>
							<div class="details">
								<span class="big"><span class="big">Report</span></span>
								<span>Rebates</span>
							</div>
						</a>
					</li>
					
					<!--li class="orange">
						<a href="<?php echo SITE_URL;?>Staffs/report_close_order?me:<?php echo $var['User']['username'];?>" rel="tooltip" data-placement="bottom" data-original-title="New Transfer Request">
							<i class="icon-spinner"></i>
							<div class="details">
								<span class="big">Report</span>
								<span>Closed Orders</span>
							</div>
						</a>
					</li-->
				</ul>
			</div>
		</div>
	</div>
	<div class="span6">
		<!-- Market Watch -->
		<div class="box box-color brown box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-th-large"></i>
					Partners Monitoring
				</h3>
			</div>
			<div class="box-content">
				<ul class="stats">
					<li class="grey">
						<a href="<?php echo SITE_URL;?>Staffs/report_commission?me:<?php echo $var['User']['username'];?>">
							<i class="icon-money"></i>
							<div class="details">
								<span class="big"><span class="big">Report</span></span>
								<span>Commissions</span>
							</div>
						</a>
					</li>

					
				</ul>
			</div>
		</div>
	</div>	
</div>