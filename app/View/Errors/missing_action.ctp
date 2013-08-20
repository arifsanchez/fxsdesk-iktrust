<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>

<div class="wrapper">
	<div class="code"><h1><i class="icon-warning-sign"></i> Access Denied !</span></h1>
	<div class="desc"><blockquote><?php echo __('Sorry, You don\'t have permission to view that page. Go back to');?> <?php echo $this->Html->link(__('Dashboard'), '/dashboard') ?></blockquote></div>

	<div class="buttons">
		<div class="pull-left"><a class="btn" href="<?php echo SITE_URL;?>"><i class="icon-arrow-left"></i> Back to Home</a></div>
	</div>
</div>

<?php 
	//logging error to special log
	$this->log('(Error) Missing action @ '.$this->request->here, 'UserPath');
	#debug($this->request->here);
?>