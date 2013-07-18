<style type="text/css">
.login-body {
	height: 415px;
	
}
.login-body h2 {
	font-size: 22px;
}
</style>


<h2><b>VERIFY EMAIL</b> or <b><?php echo $this->Html->link('SIGN IN', '/login');?></b></h2>

<?php echo $this->Form->create('User'); ?>
<div class="control-group">
	<div class="email controls">
		<?php echo $this->Form->input('email', array('label'=>false, 'div'=>false, 'class' => "input-block-level", 'placeholder' => "Your Email Address",)); ?>
	</div>
</div>
<div class="um-button-row">
	<?php echo $this->Form->Submit('Send Email', array('div'=>false, 'class'=>'btn btn-primary')); ?>
</div>
<?php echo $this->Form->end(); ?>
