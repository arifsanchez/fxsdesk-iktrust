<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal hide fade" id="DepositWallet" style="display: none;">
	<div class="modal-header">
		<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
		<h3 id="myModalLabel"><i class="icon-money"></i> Deposit to Wallet<span class="pull-right">IK$ <?php echo $bal; ?>&nbsp;</span></h3>
	</div>
	<div class="modal-body">
		<p>Deposit to IK Wallet and transfer limitless to trading account.</p>
		<div class="row-fluid">
			<!-- Deposit : Bank Transfer / Credit Card / Webmoney -->
			<div class="span12">
				<ul class="thumbnails">
					<li class="span4">
					    <a data-placement="top" title="" rel="tooltip" class="btn" href="#" data-original-title="Bank Transfer, 0% Commission"><img src="<?php echo SITE_URL;?>img/payment_channel/bn_150x100.png" alt="Bank Transfer"></a>
					    <div class="caption">
					      <p align="center"><a href="#" class="btn btn-satgreen btn-mini">Bank Transfer</a></p>
					    </div>
					</li>
					<li class="span4">
					    <a data-placement="top" title="" rel="tooltip" class="btn" href="#" data-original-title="Credit Card, 3.5% Commission"><img src="<?php echo SITE_URL;?>img/payment_channel/cc_150x100.png" alt="Credit Card"></a>
					    <div class="caption">
					      <p align="center"><a href="#" class="btn btn-satgreen btn-block">Credit Card</a></p>
					    </div>
					</li>
					<li class="span4">
					    <a data-placement="top" title="" rel="tooltip" class="btn" href="#" data-original-title="Webmoney, 1% Commission"><img src="<?php echo SITE_URL;?>img/payment_channel/wm_150x100.png" alt="Webmoney"></a>
					    <div class="caption">
					      <p align="center"><a href="#" class="btn btn-satgreen btn-block">Webmoney</a></p>
					    </div>
					</li>
				</ul>
			</div>
		</div>
		<div class="row-fluid">
			<!-- Deposit : Perfect Money / Solidtrustpay / Payza -->
			<div class="span12">
				<ul class="thumbnails">
					<li class="span4">
					    <a data-placement="top" title="" rel="tooltip" class="btn" href="#" data-original-title="Perfect Money, 1.5% Commission"><img src="<?php echo SITE_URL;?>img/payment_channel/pm_150x100.png" alt="Perfect Money"></a>
					    <div class="caption">
					      <p align="center"><a href="#" class="btn btn-satgreen btn-block">Perfect Money</a></p>
					    </div>
					</li>
					<li class="span4">
					    <a data-placement="top" title="" rel="tooltip" class="btn" href="#" data-original-title="IK Prepaid Card, 0% Commission"><img src="http://placehold.it/150x100" alt="IK Prepaid"></a>
					    <div class="caption">
					      <p align="center"><a href="#" class="btn btn-satgreen btn-block">IK Prepaid</a></p>
					    </div>
					</li>
					<li class="span4">
					    <a data-placement="top" title="" rel="tooltip" class="btn" href="#" data-original-title="Payza, 0% Commission"><img src="http://placehold.it/150x100" alt="Payza"></a>
					    <div class="caption">
					      <p align="center"><a href="#" class="btn btn-satgreen btn-block">Payza</a></p>
					    </div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		Info regarding our payment channel and partners payment channel <a class="btn btn-satblue btn-block" href="<?php echo SITE_URL;?>contents/finance_channel">Read More</a>
	</div>
</div>