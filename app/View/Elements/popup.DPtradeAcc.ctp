<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal hide fade" id="DPtradeAcc" style="display: none;">
	<div class="modal-header">
		<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
		<h3 id="myModalLabel"><i class="icon-money"></i> Transfer From Wallet</h3>
	</div>
	<div class="modal-body">
		<p>Internal transfer from wallet is the easiest way to funds your trading account.</p>
		<div class="row-fluid">
			<div class="span6">
				<h3><u>Wallet Balance</u></h3>
				<?php $bal = $this->requestAction('vaults/acc1_balance'); ?>
				<h4>IK$ <?php echo $bal; ?></h4>
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
				<h4>Account No : <?php echo $login; ?></h4>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-green">Initiate Transfer</button>
		<button data-dismiss="modal" class="btn btn-primary">Cancel</button>
	</div>
</div>