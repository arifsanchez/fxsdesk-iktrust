<?php if($this->Session->check('Message.flash')) {
	$msgClass = ($this->Session->check('Message.flash.params.class')) ? $this->Session->read('Message.flash.params.class') : 'success'; ?>
	<div class="alert alert-<?php echo $msgClass; ?>">
		<button data-dismiss="alert" class="close" type="button">×</button>
		<?php echo $this->Session->read('Message.flash.message'); ?>
	</div>
	
	<!--div class='messageHolder'><div class="alert alert-<?php echo $msgClass; ?>" id="flashMessage"><?php echo $this->Session->read('Message.flash.message'); ?></div></div-->
<?php CakeSession::delete('Message.flash'); } ?>