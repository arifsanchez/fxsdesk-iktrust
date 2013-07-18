<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>

<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('All Pages') ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Add Page', true), array('action'=>'addPage'));?>
		</span>
	</div>
	<div class="um-panel-content">
		<div id="updateContentIndex">
			<?php echo $this->element('Usermgmt.all_contents'); ?>
		</div>
	</div>
</div>