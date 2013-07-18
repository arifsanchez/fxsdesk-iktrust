<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>

<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Access Denied') ?>
		</span>
	</div>
	<div class="um-panel-content with-padding">
		<?php echo __('Sorry, You don\'t have permission to view that page. go to');?> <?php echo $this->Html->link(__('Dashboard'), '/dashboard') ?>
		<br/><br/>
		<br/><br/>
	</div>
</div>