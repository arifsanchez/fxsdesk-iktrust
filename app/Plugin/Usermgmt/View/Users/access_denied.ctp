<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>

<div class="wrapper">
	<div class="code"><h1><i class="icon-warning-sign"></i> Access Denied !</span></h1>
	<div class="desc"><blockquote><?php echo __('Sorry, You don\'t have permission to view that page. Go back to');?> <?php echo $this->Html->link(__('Dashboard'), '/dashboard') ?></blockquote></div>

	<div class="buttons">
		<div class="pull-left"><a class="btn" href="<?php echo SITE_URL;?>"><i class="icon-arrow-left"></i> Back to Home</a></div>
	</div>
</div>

<!--div class="um-panel">
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
</div-->
