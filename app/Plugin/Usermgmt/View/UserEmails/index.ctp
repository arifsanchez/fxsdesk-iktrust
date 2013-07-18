<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>

<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('All Sent Emails') ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Send Email', true), array('action'=>'send'));?>
		</span>
	</div>
	<div class="um-panel-content">
		<div id="updateUserEmailIndex">
			<?php echo $this->element('Usermgmt.all_emails'); ?>
		</div>
	</div>
</div>