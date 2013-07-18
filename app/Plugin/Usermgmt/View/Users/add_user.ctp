<?php
//following 2 files for stylish multi select
echo $this->Html->script('/usermgmt/js/chosen/chosen.jquery.js');
echo $this->Html->css('/usermgmt/css/chosen/chosen.css');
?>

<script type="text/javascript">
$(document).ready(function(e) {
	if($.fn.chosen) {
		$("#UserUserGroupId").chosen();
	}
});
</script>
<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Add User') ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Back', true), array('action'=>'index'));?>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->Html->script(array('/usermgmt/js/ajaxValidation.js?q='.QRDN)); ?>
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'addUserForm', 'submitButtonId' => 'addUserSubmitBtn')); ?>
		<?php echo $this->Form->create('User', array('id'=>'addUserForm', 'class'=>'form-horizontal')); ?>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Group');?></label>
			<div class="controls">
				<?php echo $this->Form->input('user_group_id', array('type' => 'select', 'multiple' => true, 'label'=>false, 'div'=>false, 'data-placeholder'=>'Select Group(s)')); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Username');?></label>
			<div class="controls">
				<?php echo $this->Form->input('username', array('label'=>false, 'div'=>false)); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('First Name');?></label>
			<div class="controls">
				<?php echo $this->Form->input('first_name', array('label'=>false, 'div'=>false)); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Last Name');?></label>
			<div class="controls">
				<?php echo $this->Form->input('last_name', array('label'=>false, 'div'=>false)); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Email');?></label>
			<div class="controls">
				<?php echo $this->Form->input('email', array('label'=>false, 'div'=>false)); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Password');?></label>
			<div class="controls">
				<?php echo $this->Form->input('password', array('type'=>'password', 'label'=>false, 'div'=>false)); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Confirm Password');?></label>
			<div class="controls">
				<?php echo $this->Form->input('cpassword', array('type'=>'password', 'label'=>false, 'div'=>false)); ?>
			</div>
		</div>
		<div class="um-button-row">
			<?php echo $this->Form->Submit('Add User', array('class'=>'btn btn-primary', 'id'=>'addUserSubmitBtn')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>