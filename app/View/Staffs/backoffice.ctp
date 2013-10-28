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

					<li class="lightgrey">
						<a href="<?php echo SITE_URL;?>Staffs/tracc_inactive_listing?me:<?php echo $var['User']['username'];?>">
							<i class="icon-user"></i>
							<div class="details">
								<span class="big"><?php $TotalTradersInactive = $this->requestAction('TraderAccounts/kiraTotalTradersInactive') ; echo $TotalTradersInactive;?></span>
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
								<span>Wallets</span>
							</div>
						</a>
					</li>

					<li class="grey">
						<a href="<?php echo SITE_URL;?>Staffs/vault_listing?me:<?php echo $var['User']['username'];?>">
							<i class="icon-sitemap"></i>
							<div class="details">
								<span class="big"><span class="big"><?php $JumlahActiveVaults = $this->requestAction('Staffs/JumlahActiveVaults') ; echo $JumlahActiveVaults;?></span></span>
								<span>Vaults</span>
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
		<!-- Market Watch -->
		<div class="box box-color teal box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-th-large"></i>
					Accounting Monitoring
				</h3>
			</div>
			<div class="box-content">
				<ul class="stats">
					<li class="green">
						<a href="<?php echo SITE_URL;?>Staffs/report_deposit?me:<?php echo $var['User']['username'];?>">
							<i class="icon-exchange"></i>
							<div class="details">
								<span class="big"><span class="big"><?php $JumlahDeposit = $this->requestAction('Staffs/JumlahDeposit') ; echo $this->Number->currency($JumlahDeposit, '$ '); ?></span></span>
								<span>Deposits</span>
							</div>
						</a>
					</li>

					<li class="red">
						<a href="<?php echo SITE_URL;?>Staffs/report_withdrawal?me:<?php echo $var['User']['username'];?>">
							<i class="icon-exchange"></i>
							<div class="details">
								<span class="big"><?php $JumlahWithdrawal = $this->requestAction('Staffs/JumlahWithdrawal') ;echo $this->Number->currency($JumlahWithdrawal, '$ '); ?></span>
								<span>Withdrawal</span>
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
		<div class="box box-color box-bordered brown box-small">
			<div class="box-title">
				<h3>
					<i class="icon-th-large"></i>
					Rebates Monitoring
				</h3>
			</div>
			<div class="box-content">
				<ul class="stats">
					<li class="grey">
						<a href="<?php echo SITE_URL;?>Staffs/report_rebate_loss?me:<?php echo $var['User']['username'];?>">
							<i class="icon-money"></i>
							<div class="details">
								<span class="big"><?php $JumlahRebateLoss = $this->requestAction('Staffs/JumlahRebateLoss') ;echo $this->Number->currency($JumlahRebateLoss, '$ '); ?></span>
								<span>Rebates Loss</span>
							</div>
						</a>
					</li>

					<li class="grey">
						<a href="<?php echo SITE_URL;?>Staffs/report_rebate_profit?me:<?php echo $var['User']['username'];?>">
							<i class="icon-money"></i>
							<div class="details">
								<span class="big"><?php $JumlahRebateProfit = $this->requestAction('Staffs/JumlahRebateProfit') ;echo $this->Number->currency($JumlahRebateProfit, '$ '); ?></span>
								<span>Rebates Profit</span>
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
					Commissions Monitoring
				</h3>
			</div>
			<div class="box-content">
				<ul class="stats">
					<li class="grey">
						<a href="<?php echo SITE_URL;?>Staffs/report_commission?me:<?php echo $var['User']['username'];?>">
							<i class="icon-money"></i>
							<div class="details">
								<span class="big"><?php $JumlahCommission = $this->requestAction('Staffs/JumlahCommission') ;echo $this->Number->currency($JumlahCommission, '$ '); ?></span>
								<span>Affilliater's</span>
							</div>
						</a>
					</li>

					<li class="grey">
						<a href="<?php echo SITE_URL;?>Staffs/report_commission_partner?me:<?php echo $var['User']['username'];?>">
							<i class="icon-money"></i>
							<div class="details">
								<span class="big"><?php $JumlahCommissionPartner = $this->requestAction('Staffs/JumlahCommissionPartner') ;echo $this->Number->currency($JumlahCommissionPartner, '$ '); ?></span>
								<span>MasterIB's</span>
							</div>
						</a>
					</li>

					
				</ul>
			</div>
		</div>
	</div>	
</div>