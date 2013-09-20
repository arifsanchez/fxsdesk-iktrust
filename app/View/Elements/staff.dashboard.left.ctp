<div class="subnav">
	<div class="subnav-title">
		<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>TrAcc Stats</span></a>
	</div>
	<div class="subnav-content">
		<div class="pagestats">
			<span class="left"><b>TraAccs Balance</b></span>
			<span class="left label label-important">
				<?php $TotalTracc = $this->requestAction('Mt4Users/kiraTotalTracc') ; echo $this->Number->currency($TotalTracc,'USD');?>
			</span>
		</div>
		<br/>
		<div class="pagestats">
			<span class="left"><b>TraAccs Credit</b></span>
			<span class="left label label-important">
				<?php $TotalTraccCR = $this->requestAction('Mt4Users/kiraTotalTraccCR') ; echo $this->Number->currency($TotalTraccCR,'USD');?>
			</span>
		</div>
		<br/>
	</div>
</div>
<div class="subnav">
	<div class="subnav-title">
		<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Wallet Stats</span></a>
	</div>
	<div class="subnav-content">
		<div class="pagestats">
			<span class="left"><b>Clients</b></span>
			<span class="left label label-success">
				<?php $TotalWallet = $this->requestAction('vaults/kiraTotalWalletClient') ; echo $this->Number->currency($TotalWallet,'IK$ ');?>
			</span>
		</div>
		<br/>
		<div class="pagestats">
			<span class="left"><b>Partners</b></span>
			<span class="left label label-success">
				<?php 
					$TotalWalletPartner = $this->requestAction('vaults/kiraTotalWalletPartner');echo $this->Number->currency($TotalWalletPartner,'IK$ ');?>
			</span>
		</div>
	</div>
</div>
<div class="subnav">
	<div class="subnav-title">
		<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Client P/L</span></a>
	</div>
	<div class="subnav-content">
		<?php 
			$jumlahSemalam = $this->requestAction('staffs/profitLossClient_semalam');
			$jst = intval($jumlahSemalam['total']);
			if($jst != null){
		?>
		<div class="pagestats">
			<span class="left"><b>Yesterday</b></span><br/>
			<span class="left label label-red">
				
				<?php
					#echo $this->Number->currency($jst, '$');
					setlocale(LC_MONETARY, 'en_US');
					echo money_format('%=*(#9.2n', $jst);
				?>
			</span>
		</div>
		<br/>
		<?php }; ?>
		<?php 
			$jumlahHariNi = $this->requestAction('staffs/profitLossClient_hariNi') ;
			$jhn = intval($jumlahHariNi['total']);
			if($jhn != null){
		?>
		<div class="pagestats">
			<span class="left"><b>Today</b></span><br/>
			<span class="left label label-red">
				
				<?php
					#echo $this->Number->currency($jhn, '$');
					setlocale(LC_MONETARY, 'en_US');
					echo money_format('%=*(#9.2n', $jhn);
				?>
			</span>
		</div>
		<?php } ?>
	</div>
</div>