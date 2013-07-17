<h2><b>RESET PASSWORD</b> or <b><?php echo $this->Html->link('SIGN IN', '/login');?></b></h2>

<?php 
	echo $this->Form->create('User'); 
?>

<div class="control-group">
	<div class="email controls">
		<input id="UserEmail" type="text" name='data[User][email]' placeholder="Email address" class='input-block-level' data-rule-required="true" data-rule-email="true">
	</div>
</div>

<div class="um-button-row">
	<?php echo $this->Form->Submit('Send Email', array('div'=>false, 'class'=>'btn btn-primary')); ?>
</div>
<?php echo $this->Form->end(); ?>