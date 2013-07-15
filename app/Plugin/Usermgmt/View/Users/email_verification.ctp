<h2><b>VERIFY EMAIL</b> or <b><?php echo $this->Html->link('SIGN IN', '/login');?></b></h2>

<?php echo $this->Form->create('User', array('class'=>'form-horizontal')); ?>
<div class="um-form-row control-group">
	<label class="control-label required"><?php echo __('Enter Email / Username');?></label>
	<div class="controls">
		<?php echo $this->Form->input('email', array('label'=>false, 'div'=>false)); ?>
	</div>
</div>
<div class="um-button-row">
	<?php echo $this->Form->Submit('Send Email', array('div'=>false, 'class'=>'btn btn-primary')); ?>
</div>
<?php echo $this->Form->end(); ?>
