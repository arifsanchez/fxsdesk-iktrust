<div class="subnav">
	<div class="subnav-title">
		<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Partner Stats</span></a>
	</div>
	<div class="subnav-content">
		<div class="pagestats">
			<span class="left"><b>Total Clients</b></span>
			<span class="left">
				<a
					data-original-title="View all client accounts"
					rel="tooltip"
					data-placement="bottom"
					class="btn" 
					href="<?php echo SITE_URL;?>Partners/myclient?me:<?php echo $var['User']['username'];?>"
					title="" 
					data-trigger="hover" 
					data-toggle="modal"	
				>
				<i class="icon-group"></i> <?php $TotalClient = $this->requestAction('partners/kiraTotalClient') ; echo $TotalClient;?>
				</a>
			</span>

		</div>
		<div class="pagestats">
			<span class="left"><b>Total Accounts</b></span>
			<span class="left">
				<a
						data-original-title="View all trading accounts"
						rel="tooltip"
						data-placement="bottom"
						class="btn" 
						href="<?php echo SITE_URL;?>Partners/mynetwork?me:<?php echo $var['User']['username'];?>"
						title="" 
						data-trigger="hover" 
						data-toggle="modal"	
					>
				<i class="icon-group"></i> <?php $TotalDownline = $this->requestAction('partners/kiraTotalDownline') ; echo $TotalDownline;?>
				</a>
			</span>
		</div>
		<div class="pagestats">
			<span class="left"><b>Total Agents</b></span>
			<span class="left">
				<a
					data-original-title="View all agent accounts"
					rel="tooltip"
					data-placement="bottom"
					class="btn" 
					href="<?php echo SITE_URL;?>Partners/myagent?me:<?php echo $var['User']['username'];?>"
					title="" 
					data-trigger="hover" 
					data-toggle="modal"	
				>
				<i class="icon-group"></i> <?php $TotalAgent = $this->requestAction('partners/kiraTotalAgent') ; echo $TotalAgent;?>
				</a>
			</span>
		</div>
		<div class="pagestats">
			<span class="left"><b>Commissions</b></span>
			<span class="left">
				<a
					data-original-title="View all commission history"
					rel="tooltip"
					data-placement="bottom"
					class="btn" 
					href="<?php echo SITE_URL;?>Partners/history?me:<?php echo $var['User']['username'];?>"
					title="" 
					data-trigger="hover" 
					data-toggle="modal"	
				>
				<i class="icon-money"></i> <?php $TotalComm = $this->requestAction('partners/kiraTotalComm') ; echo $this->Number->currency($TotalComm, 'IK$ ');?>
				</a>
			</span>
		</div>
	</div>
</div>