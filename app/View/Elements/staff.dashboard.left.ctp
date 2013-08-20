<div class="subnav">
	<div class="subnav-title">
		<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Risk Stats</span></a>
	</div>
	<div class="subnav-content">
		<div class="pagestats">
			<span class="left"><b>Unrealized Risk</b></span>
			<span class="left label label-important">
				<?php $TotalTracc = $this->requestAction('Mt4Users/kiraTotalTracc') ; echo $this->Number->currency($TotalTracc,'USD');?>
			</span>
		</div>
		<br/>
		<div class="pagestats">
			<span class="left"><b>Clients Wallet</b></span>
			<span class="left label label-success">
				<?php $TotalWallet = $this->requestAction('vaults/kiraTotalWallet') ; echo $this->Number->currency($TotalWallet,'USD');?>
			</span>
		</div>
	</div>
</div>
<div class="subnav">
	<div class="subnav-title">
		<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Client Stats</span></a>
	</div>
	<div class="subnav-content">
		<div class="pagestats">
			<span class="left"><b>Active Clients</b></span>
			<span class="left"><i class="icon-user"></i> 
				<?php $TotalRegClients = $this->requestAction('usermgmt/Users/kiraTotalClient') ; echo $TotalRegClients;?>
			</span>
		</div>

		<div class="pagestats">
			<span class="left"><b>Trade Accounts</b></span>
			<span class="left"><i class="icon-user"></i> 
				<?php $TotalAccs = $this->requestAction('Mt4Users/kiraTotalAccs') ; echo $TotalAccs;?>
			</span>
		</div>
	</div>
</div>