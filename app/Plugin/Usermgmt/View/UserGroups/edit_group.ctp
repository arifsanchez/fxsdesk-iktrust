<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Edit Group') ?>
		</span>
		<span class="um-panel-title-right">
			<?php $page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1; ?>
			<?php echo $this->Html->link(__('Back', true), array('action'=>'index', 'page'=>$page));?>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->Html->script(array('/usermgmt/js/ajaxValidation.js?q='.QRDN)); ?>
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'editGroupForm', 'submitButtonId' => 'editGroupSubmitBtn')); ?>
		<?php echo $this->Form->create('UserGroup', array('id'=>'editGroupForm', 'class'=>'form-horizontal')); ?>
		<?php echo $this->Form->hidden('id'); ?>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Group Name');?></label>
			<div class="controls">
				<?php echo $this->Form->input('name', array('label'=>false, 'div'=>false)); ?>
				<?php echo __('for ex. Business User');?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Alias Group Name');?></label>
			<div class="controls">
				<?php echo $this->Form->input('alias_name', array('label'=>false, 'div'=>false)); ?>
				<?php echo __('for ex. Business_User (Must not contain space)');?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label"><?php echo __('Parent Group');?></label>
			<div class="controls">
				<?php echo $this->Form->input('parent_id', array('type' => 'select', 'label'=>false, 'div'=>false, 'options'=>$parentGroups)); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label"><?php echo __('Description');?></label>
			<div class="controls">
				<?php echo $this->Form->input('description', array('type'=>'textarea', 'label'=>false, 'div'=>false)); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label"><?php echo __('Allow Registration');?></label>
			<div class="controls">
				<?php echo $this->Form->input('allowRegistration', array('type'=>'checkbox', 'label'=>false, 'div'=>false)); ?>
			</div>
		</div>
		<div class="um-button-row">
			<?php echo $this->Form->Submit('Update Group', array('class'=>'btn btn-primary', 'id'=>'editGroupSubmitBtn')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>