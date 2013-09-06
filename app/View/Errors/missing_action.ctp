<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>

<div class="row-fluid">
	<div class="span12">
		<div class="wrapper">
			<div class="code"><h1><i class="icon-warning-sign"></i> Access Denied !</span></h1>
			<div class="desc">

				<blockquote><?php echo __('Sorry, You don\'t have permission to view that page. Go back to');?> <?php echo $this->Html->link(__('Dashboard'), '/dashboard') ?></blockquote>

				<p class="error">
					<strong><?php echo __d('cake_dev', 'Error'); ?>: </strong>
					<?php echo __d('cake_dev', 'The action %1$s is not defined in controller %2$s', '<em>' . h($action) . '</em>', '<em>' . h($controller) . '</em>'); ?>
				</p>
				<p class="error">
					<strong><?php echo __d('cake_dev', 'Error'); ?>: </strong>
					<?php echo __d('cake_dev', 'Create %1$s%2$s in file: %3$s.', '<em>' . h($controller) . '::</em>', '<em>' . h($action) . '()</em>', APP_DIR . DS . 'Controller' . DS . h($controller) . '.php'); ?>
				</p>
			</div>

			<div class="buttons">
				<div class="pull-left"><a class="btn" href="<?php echo SITE_URL;?>"><i class="icon-arrow-left"></i> Back to Home</a></div>
			</div>
		</div>
	</div>
</div>
<?php 
	//logging error to special log
	$this->log('(Error) Missing action @ '.$this->request->here, 'UserPath');
	#debug($this->request->here);
?>