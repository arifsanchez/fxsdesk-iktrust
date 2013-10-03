<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal hide fade" id="DPmaybank-<?php echo $var['User']['id'];?>" style="display: none;">
	<div class="modal-header">
		<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
		<h3 id="myModalLabel"><i class="icon-money"></i> Deposit To Maybank (Malaysia)</h3>
	</div>
	
	<div class="modal-body">
	<div class="row-fluid">
		<div class="span5">
			<?php
				echo "<blockquote>My Wallet balance <br/><span class='label label-satblue'>". $this->Number->Currency($bal, 'IK$ ')."</span></blockquote>";
				echo $this->Js->each('alert("whoa!");', true);
			?>
			<p>
				<b>Daily Rate</b><br/>
				1 IK$ ~ MYR 3.5
			</p>
		</div>
		<div class="span7">
			<?php
				echo $this->Form->create('Vault', array('action' => 'request_deposit_banktransfer'));
				echo $this->Form->label('Amount to deposit ($)');
				echo "<div class='controls'><div class='input-append input-prepend'>";
				echo $this->Form->input('amount', array(
					'label' => false,
					'data-rule-required' => 'true',
					'data-rule-number' => 'true',
					'placeholder' => 'Max '.$this->Number->Currency('100000', 'IK$ '),
					'class' => 'input-medium',
					'div' => false,
					'before' => "<span class='add-on'><i class='icon-money'></i></span>",
					'after' => "<span class='add-on'>.00</span>"
				));
				echo "</div></div>";

				echo $this->Form->hidden('siapa', array('value' => $uid));
				echo $this->Form->hidden('channel', array('value' => 'MBB-IKMT'));
				$options = array(
				    'label' => 'Submit Deposit Request',
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