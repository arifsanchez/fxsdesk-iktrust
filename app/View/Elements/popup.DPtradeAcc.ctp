<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal hide fade" id="DPtradeAcc" style="display: none;">
	<div class="modal-header">
		<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
		<h3 id="myModalLabel"><i class="icon-money"></i> Transfer From Wallet</h3>
	</div>
	
	<div class="modal-body">
	<div class="row-fluid">
		<div class="span6 box box-borderedbox">
			<?php 

				echo $this->Form->create('Vault', array('action' => 'procdpaccwallet'));
				echo "<blockquote>Current Wallet balance <span class='label label-important'>IK$ ". $bal."</span></blockquote>";
			?>
		</div>
		<div class="span6">
			<?php
				echo $this->Form->label('Amount To Transfer');
				echo "<div class='controls'><div class='input-append input-prepend'>";
				echo $this->Form->input('amount', array(
					'label' => false,
					'data-rule-required' => 'true',
					'data-rule-number' => 'true',
					'placeholder' => 'Max IK$'.$bal,
					'class' => 'input-small',
					'div' => false,
					'before' => "<span class='add-on'><i class='icon-money'></i></span>",
					'after' => "<span class='add-on'>.00</span>"
				));
				echo "</div></div>";

				echo $this->Form->hidden('acc_trading', array('value' => $login));
				$options = array(
				    'label' => 'Submit Transfer Request',
				    'div' => null,
				    'class' => 'btn btn-green'
				);
				echo $this->Form->end($options); 
			?>
		</div>
	</div>
	</div>
	<div class="modal-footer">
		<button data-dismiss="modal" class="btn btn-grey">Cancel</button>
	</div>

</div>