<?php if($status == 1){?>
<li>
	<?php 
		echo $this->Form->create('Staff', array('action' => 'updateTransactionStatus_code'.$type, 'style' => 'margin-bottom:1px !important'));
		echo $this->Form->hidden('transid', array('value' => $TranDetails['VaultTransaction']['id']));
		echo $this->Form->hidden('jumlah', array('value' => $TranDetails['VaultTransaction']['jumlah']));
		echo $this->Form->hidden('userId', array('value' => $userDetails['User']['id']));
		echo $this->Form->hidden('staffId', array('value' => $var['User']['id']));
		echo $this->Form->hidden('traccId', array('value' => $TranDetails['VaultTransaction']['tracc_no']));
		echo $this->Form->hidden('status', array('value' => 2));
		echo $this->Form->button('Pending', array('class' => 'btn btn-satblue btn-block'));
		echo $this->Form->end();
	?>
</li>
<?php }?>
<?php if($status == 2){?>
<li>
	<?php 
		echo $this->Form->create('Staff', array('action' => 'updateTransactionStatus_code'.$type, 'style' => 'margin-bottom:1px !important'));
		echo $this->Form->hidden('transid', array('value' => $TranDetails['VaultTransaction']['id']));
		echo $this->Form->hidden('jumlah', array('value' => $TranDetails['VaultTransaction']['jumlah']));
		echo $this->Form->hidden('userId', array('value' => $userDetails['User']['id']));
		echo $this->Form->hidden('staffId', array('value' => $var['User']['id']));
		echo $this->Form->hidden('traccId', array('value' => $TranDetails['VaultTransaction']['tracc_no']));
		echo $this->Form->hidden('status', array('value' => 4));
		echo $this->Form->button('Decline', array('class' => 'btn btn-red btn-block'));
		echo $this->Form->end();
	?>
</li>
<li>
	<?php 
		echo $this->Form->create('Staff', array('action' => 'updateTransactionStatus_code'.$type,  'style' => 'margin-bottom:1px !important'));
		echo $this->Form->hidden('transid', array('value' => $TranDetails['VaultTransaction']['id']));
		echo $this->Form->hidden('jumlah', array('value' => $TranDetails['VaultTransaction']['jumlah']));
		echo $this->Form->hidden('userId', array('value' => $userDetails['User']['id']));
		echo $this->Form->hidden('staffId', array('value' => $var['User']['id']));
		echo $this->Form->hidden('traccId', array('value' => $TranDetails['VaultTransaction']['tracc_no']));
		echo $this->Form->hidden('status', array('value' => 3));
		echo $this->Form->button('Approve', array('class' => 'btn btn-green btn-block'));
		echo $this->Form->end();
	?>
</li>
<?php }?>
<?php if($status == 4){?>
<li>
	<?php 
		echo $this->Form->create('Staff', array('action' => 'updateTransactionStatus_code'.$type,  'style' => 'margin-bottom:1px !important'));
		echo $this->Form->hidden('transid', array('value' => $TranDetails['VaultTransaction']['id']));
		echo $this->Form->hidden('jumlah', array('value' => $TranDetails['VaultTransaction']['jumlah']));
		echo $this->Form->hidden('userId', array('value' => $userDetails['User']['id']));
		echo $this->Form->hidden('staffId', array('value' => $var['User']['id']));
		echo $this->Form->hidden('traccId', array('value' => $TranDetails['VaultTransaction']['tracc_no']));
		echo $this->Form->hidden('status', array('value' => 1));
		echo $this->Form->button('RESET', array('class' => 'btn btn-magenta btn-block'));
		echo $this->Form->end();
	?>
</li>
<?php }?>