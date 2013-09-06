<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>

<div class="row-fluid">
	<div class="span6">
		<div class="wrapper">
			<div class="code"><h1><i class="icon-warning-sign"></i> Access Denied !</span></h1>
			<div class="desc"><blockquote><?php echo __('Sorry, You don\'t have permission to view that page. Go back to');?> <?php echo $this->Html->link(__('Dashboard'), '/dashboard') ?></blockquote></div>

			<div class="buttons">
				<div class="pull-left"><a class="btn" href="<?php echo SITE_URL;?>"><i class="icon-arrow-left"></i> Back to Home</a></div>
			</div>
		</div>
	</div>
	<div class="span6">
		<p class="error">
			<strong><?php echo __d('cake_dev', 'Error'); ?>: </strong>
			<?php echo h($error->getMessage()); ?>
			<br>

			<strong><?php echo __d('cake_dev', 'File'); ?>: </strong>
			<?php echo h($error->getFile()); ?>
			<br>

			<strong><?php echo __d('cake_dev', 'Line'); ?>: </strong>
			<?php echo h($error->getLine()); ?>
		</p>
	</div>
</div>

<?php 
	//logging error to special log

	$this->log('(Error) Fatal Error @ '.$this->request->here, 'UserPath');
	#debug($this->request->here);
?>
