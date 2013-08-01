<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal hide fade" id="WDtradeAcc<?php echo $login;?>" style="display: none;">
	<div class="modal-header">
		<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
		<h3 id="myModalLabel"><i class="icon-money"></i> Withdraw To Wallet</h3>
	</div>
	<div class="modal-body">
		<p>Thank you for your interest, these feature will be available soon.</p>
		<div class="row-fluid">
			<div class="span6">
				<h3><u>Trading Account</u></h3>
				<h4>Balance : US$ <?php echo number_format($balance, 2, '.', ''); ?></h4>
				<form class="form-inline">
		            <div class="input-prepend input-append">
		              <span class="add-on">$</span>
		              <input type="text" class="span6">
		              <span class="add-on">.00</span>
		            </div>
		        </form>
			</div>
			<div class="span6">
				<h3><u>Transfer To</u></h3>
				<h4>Wallet IK$ <?php echo $bal; ?></h4>
				
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-red">Initiate Transfer</button>
		<button data-dismiss="modal" class="btn btn-grey">Cancel</button>
	</div>
</div>