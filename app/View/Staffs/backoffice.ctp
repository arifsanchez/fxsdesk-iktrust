<?php 
	#echo pr($var);
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
			</div>
			<div class="box-content">
				<ul class="stats">
					<li class="blue">
						<a href="<?php echo SITE_URL;?>usermgmt/Users/index?me:<?php echo $var['User']['username'];?>">
							<i class="icon-user"></i>
							<div class="details">
								<span class="big"><?php $TotalRegClients = $this->requestAction('usermgmt/Users/kiraTotalClient') ; echo $TotalRegClients;?></span>
								<span>Clients</span>
							</div>
						</a>
					</li>
					<li class="satblue">
						<a href="<?php echo SITE_URL;?>Staffs/admin_listing?me:<?php echo $var['User']['username'];?>">
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

		<div class="box box-color box-bordered magenta box-small">
			<div class="box-title">
				<h3>
					<i class="icon-th-large"></i>
					Finance Queue
				</h3>
			</div>
			<div class="box-content">
				<ul class="stats">
					<li class="satgreen">
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
					</li>

					<li class="orange">
						<a href="<?php echo SITE_URL;?>Staffs/transfer_request?me:<?php echo $var['User']['username'];?>" rel="tooltip" data-placement="bottom" data-original-title="New Transfer Request">
							<i class="icon-money"></i>
							<div class="details">
								<span class="big"><?php $TotalTRW_TRACC = $this->requestAction('vaults/kiraTotalNewTRW_TRACC'); echo $TotalTRW_TRACC;?></span>
								<span>Transfer</span>
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
						<a href="<?php echo SITE_URL;?>Users/index?me:<?php echo $var['User']['username'];?>">
							<i class="icon-group"></i>
							<div class="details">
								<span class="big"><span class="big"><?php $TotalRegPartners = $this->requestAction('usermgmt/Users/kiraTotalPartner') ; echo $TotalRegPartners;?></span></span>
								<span>Partners</span>
							</div>
						</a>
					</li>

					<li class="lightgrey">
						<a href="<?php echo SITE_URL;?>Users/index?me:<?php echo $var['User']['username'];?>">
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