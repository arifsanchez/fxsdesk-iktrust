<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal hide fade" id="DepositWallet" style="display: none;">
	<div class="modal-header">
		<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
		<h3 id="myModalLabel"><i class="icon-money"></i> Deposit to Wallet
			<span class="pull-right">
				<button class="btn btn-success" disabled><b>IK$ <?php echo $bal; ?></b></button>&nbsp;
			</span>
		</h3>
	</div>
	<div class="modal-body">
		<p>Deposit to IK Wallet and transfer limitless to trading account.</p>
		<div class="row-fluid">
			<!-- Deposit : Bank Transfer / Credit Card / IK Topup -->
			<div class="span12">
				<ul class="thumbnails">
					<li class="span4">
					    <a data-placement="top" title="" rel="tooltip" class="btn" href="<?php echo SITE_URL;?>Vaults/dp_banktransfer/for:<?php echo $uname;?>/i:<?php echo $uid;?>" data-original-title="Bank Transfer, 0% Commission"><img src="<?php echo SITE_URL;?>img/payment_channel/bt_150x100.png" alt="Bank Transfer"></a>
					    <div class="caption">
					      <p align="center"><a href="<?php echo SITE_URL;?>Vaults/dp_banktransfer/for:<?php echo $uname;?>/i:<?php echo $uid;?>" class="btn btn-satgreen btn-block">Bank transfer</a></p>
					    </div>
					</li>
					<li class="span4">
					    <a data-placement="top" title="" rel="tooltip" class="btn" href="<?php echo SITE_URL;?>Vaults/dp_ikcard/for:<?php echo $uname;?>/i:<?php echo $uid;?>" data-original-title="IK Topup Card, 0% Commission"><img src="<?php echo SITE_URL;?>img/payment_channel/ik_150x100.png" alt="IK Topup Card"></a>
					    <div class="caption">
					      <p align="center"><a href="<?php echo SITE_URL;?>Vaults/dp_ikmarketplace/for:<?php echo $uname;?>/i:<?php echo $uid;?>" class="btn btn-satgreen btn-block">IK Marketplace</a></p>
					    </div>
					</li>
					<li class="span4">
					    <a data-placement="top" title="" rel="tooltip" class="btn" href="<?php echo SITE_URL;?>Vaults/dp_creditcard/for:<?php echo $uname;?>/i:<?php echo $uid;?>" data-original-title="Credit Card, 3.5% Commission"><img src="<?php echo SITE_URL;?>img/payment_channel/cc_150x100.png" alt="Credit Card"></a>
					    <div class="caption">
					      <p align="center"><a href="<?php echo SITE_URL;?>Vaults/dp_creditcard/for:<?php echo $uname;?>/i:<?php echo $uid;?>" class="btn btn-satgreen btn-block">Paypal</a></p>
					    </div>
					</li>
					
				</ul>
			</div>
		</div>
		<!-- Deposit : Perfect Money / Webmoney / Payza -->
		<!--div class="row-fluid">
			<div class="span12">
				<ul class="thumbnails">
					<li class="span4">
					    <a data-placement="top" title="" rel="tooltip" class="btn" href="<?php echo SITE_URL;?>Vaults/dp_perfectmoney/for:<?php echo $uname;?>/i:<?php echo $uid;?>" data-original-title="Perfect Money, 1.5% Commission"><img src="<?php echo SITE_URL;?>img/payment_channel/pm_150x100.png" alt="Perfect Money"></a>
					    <div class="caption">
					      <p align="center"><a href="<?php echo SITE_URL;?>Vaults/dp_perfectmoney/for:<?php echo $uname;?>/i:<?php echo $uid;?>" class="btn btn-satgreen btn-block">Perfect Money</a></p>
					    </div>
					</li>
					<li class="span4">
					    <a data-placement="top" title="" rel="tooltip" class="btn" href="<?php echo SITE_URL;?>Vaults/dp_webmoney/for:<?php echo $uname;?>/i:<?php echo $uid;?>" data-original-title="Webmoney, 1.2% Commission"><img src="<?php echo SITE_URL;?>img/payment_channel/wm_150x100.png" alt="Webmoney"></a>
					    <div class="caption">
					      <p align="center"><a href="<?php echo SITE_URL;?>Vaults/dp_webmoney/for:<?php echo $uname;?>/i:<?php echo $uid;?>" class="btn btn-satgreen btn-block">Webmoney</a></p>
					    </div>
					</li>
					<li class="span4">
					    <a data-placement="top" title="" rel="tooltip" class="btn" href="<?php echo SITE_URL;?>Vaults/dp_payza/for:<?php echo $uname;?>/i:<?php echo $uid;?>" data-original-title="Payza, 1.5% Commission"><img src="<?php echo SITE_URL;?>img/payment_channel/pz_150x100.png" alt="Payza"></a>
					    <div class="caption">
					      <p align="center"><a href="<?php echo SITE_URL;?>Vaults/dp_payza/for:<?php echo $uname;?>/i:<?php echo $uid;?>" class="btn btn-satgreen btn-block">Payza</a></p>
					    </div>
					</li>
				</ul>
			</div>
		</div-->
	</div>
	<div class="modal-footer">
		<center>Read info regarding our payment channel and partners payment channel</center>
		<a class="btn btn-satblue btn-block" href="<?php echo SITE_URL;?>contents/finance_channel">Read More</a>
	</div>
</div>