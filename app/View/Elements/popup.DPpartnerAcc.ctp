<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal hide fade" id="DPpartnerAcc<?php echo $login;?>" style="display: none;">
	<div class="modal-header">
		<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
		<h3 id="myModalLabel"><i class="icon-money"></i> Transfer From Wallet</h3>
	</div>
	
	<div class="modal-body">
	<div class="row-fluid">
		<div class="span5">
			<?php
				echo "<blockquote>Partner Vault balance <br/><span class='label label-satblue'>". $this->Number->Currency($bal, 'IK$ ')."</span></blockquote>";
				echo "<blockquote>".$login." Account balance <br/><span class='label label-orange'>". $this->Number->Currency($balance, 'US$ ')."</span></blockquote>";
			?>
		</div>
		<div class="span7">
			<?php
				echo $this->Form->create('Vault', array('action' => 'procdpaccwallet'));
				echo $this->Form->label('Amount To Transfer');
				echo "<div class='controls'><div class='input-append input-prepend'>";
				echo $this->Form->input('amount', array(
					'label' => false,
					'data-rule-required' => 'true',
					'data-rule-number' => 'true',
					'placeholder' => 'Max '.$this->Number->Currency($bal, 'IK$ '),
					'class' => 'input-medium',
					'div' => false,
					'before' => "<span class='add-on'><i class='icon-money'></i></span>",
					'after' => "<span class='add-on'>.00</span>"
				));
				echo "</div></div>";

				echo $this->Form->hidden('acc_trading', array('value' => $login));
				echo $this->Form->hidden('partner', array('value' => 'yes'));
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