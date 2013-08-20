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