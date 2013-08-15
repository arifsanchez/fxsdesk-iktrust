<div class="subnav">
	<div class="subnav-title">
		<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Partner Stats</span></a>
	</div>
	<div class="subnav-content">
		<div class="pagestats">
			<span class="left"><b>Total Accounts</b></span>
			<span class="left label label-success"><i class="icon-group"></i> <?php $TotalDownline = $this->requestAction('partners/kiraTotalDownline') ; echo $TotalDownline;?></span>
		</div>
		<div class="pagestats">
			<span class="left"><b>Total Agents</b></span>
			<span class="left"><i class="icon-group"></i> <?php $TotalAgent = $this->requestAction('partners/kiraTotalAgent') ; echo $TotalAgent;?></span>
		</div>
	</div>
</div>