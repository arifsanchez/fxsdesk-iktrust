<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal hide fade" id="WDtradeAcc" style="display: none;">
	<div class="modal-header">
		<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
		<h3 id="myModalLabel"><i class="icon-money"></i> Withdraw To Wallet</h3>
	</div>
	<div class="modal-body">
		<p>Thank you for your interest, these feature will be available soon.</p>
		<div class="row-fluid">
			<div class="span6">
				<h3><u>Trading Account</u></h3>
				<?php $bal = $this->requestAction('vaults/acc1_balance'); ?>
				<h4>US$ <?php echo $bal; ?></h4>
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
				<?php $bal = $this->requestAction('vaults/acc1_balance'); ?>
				<h4>Wallet IK$ <?php echo $bal; ?></h4>
				
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button data-dismiss="modal" class="btn btn-primary">Close</button>
	</div>
</div>