<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>

<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('All Email Signatures') ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Add Signature', true), array('action'=>'add'));?>
		</span>
	</div>
	<div class="um-panel-content">
		<div id="updateUserEmailSignatureIndex">
			<?php echo $this->element('Usermgmt.all_email_signatures'); ?>
		</div>
	</div>
</div>