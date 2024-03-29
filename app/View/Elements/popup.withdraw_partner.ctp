<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal hide fade" id="WithdrawWallet_partner" style="display: none;">
	<div class="modal-header">
		<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
		<h3 id="myModalLabel"><i class="icon-money"></i> Withdraw from IK Wallet
		<span class="pull-right">
			<button class="btn btn-success" disabled><?php echo $this->Number->Currency($bal, 'IK$ '); ?></button>&nbsp;
		</span>
		</h3>
	</div>
	<div class="modal-body">
		<p>The safest way to withdraw your IK Wallet fund via many of our payment channel.</p>
		<div class="row-fluid">
			<!-- Withdraw : Bank Transfer / IK Marketplace / Paypal -->
			<div class="span12">
				<ul class="thumbnails">
					<li class="span4">
					    <a data-placement="top" title="" rel="tooltip" class="btn" href="#" data-original-title="Bank Transfer, 1.5% Commission"><img src="<?php echo SITE_URL;?>img/payment_channel/bt_150x100.png" alt="Bank Transfer"></a>
					    <div class="caption">
					      <p align="center"><a href="#" class="btn btn-lightred btn-block">Bank transfer</a></p>
					    </div>
					</li>
					<li class="span4">
					    <a data-placement="top" title="" rel="tooltip" class="btn" href="#" data-original-title="IK Marketplace, 0% Commission"><img src="<?php echo SITE_URL;?>img/payment_channel/ik_150x100.png" alt="IK Topup Card"></a>
					    <div class="caption">
					      <p align="center"><a href="#" class="btn btn-lightred btn-block">IK Marketplace</a></p>
					    </div>
					</li>
					<li class="span4">
					    <a data-placement="top" title="" rel="tooltip" class="btn" href="#" data-original-title="Paypal, 3.5% Commission"><img src="<?php echo SITE_URL;?>img/payment_channel/cc_150x100.png" alt="Webmoney"></a>
					    <div class="caption">
					      <p align="center"><a href="#" class="btn btn-lightred btn-block">Paypal</a></p>
					    </div>
					</li>
				</ul>
			</div>
		</div>
		<!-- Withdraw : Perfect Money/ Payza -->
		<!--div class="row-fluid">
			<div class="span12">
				<ul class="thumbnails">
					<li class="span4">
					    <a data-placement="top" title="" rel="tooltip" class="btn" href="#" data-original-title="Perfect Money, 1.5% Commission"><img src="<?php echo SITE_URL;?>img/payment_channel/pm_150x100.png" alt="Perfect Money"></a>
					    <div class="caption">
					      <p align="center"><a href="#" class="btn btn-lightred btn-block">Perfect Money</a></p>
					    </div>
					</li>
					
					<li class="span4">
					    <a data-placement="top" title="" rel="tooltip" class="btn" href="#" data-original-title="Payza, 1.5% Commission"><img src="<?php echo SITE_URL;?>img/payment_channel/pz_150x100.png" alt="Payza"></a>
					    <div class="caption">
					      <p align="center"><a href="#" class="btn btn-lightred btn-block">Payza</a></p>
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