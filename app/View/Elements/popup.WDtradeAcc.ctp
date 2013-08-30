<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="1" class="modal hide fade" id="WDtradeAcc" style="display: none;">
	<div class="modal-header">
		<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
		<h3 id="myModalLabel"><i class="icon-money"></i> Withdraw To Wallet</h3>
	</div>
	
	<div class="modal-body">
	<div class="row-fluid">

		<div class="span7">
			<?php
				echo $this->Form->create('Vault', array('action' => 'procwdaccwallet'));
				echo $this->Form->label('Amount To Transfer');
				echo "<div class='controls'><div class='input-append input-prepend'>";
				echo $this->Form->input('amount', array(
					'label' => false,
					'data-rule-required' => 'true',
					'data-rule-number' => 'true',
					'placeholder' => 'Max '.$this->Number->Currency($traccbal, 'US$ '),
					'class' => 'input-medium',
					'div' => false,
					'before' => "<span class='add-on'><i class='icon-money'></i></span>",
					'after' => "<span class='add-on'>.00</span>"
				));
				echo "</div></div>";

				echo $this->Form->hidden('acc_trading', array('value' => $login));
				$options = array(
				    'label' => 'Submit Transfer Request',
				    'div' => null,
				    'class' => 'btn btn-red'
				);
				echo $this->Form->end($options); 
			?>
		</div>
		<div class="span5">
			<?php 
				echo "<blockquote>".$login." Account balance <br/><span class='label label-important'>". $this->Number->Currency($traccbal, 'US$ ')."</span></blockquote>";
			?>
		</div>
		
	</div>
	</div>
	<div class="modal-footer">
		<button data-dismiss="modal" class="btn btn-grey">Cancel</button>
	</div>

</div>