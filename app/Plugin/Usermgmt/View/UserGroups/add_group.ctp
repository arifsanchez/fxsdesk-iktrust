
<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Add Group') ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Back', true), array('action'=>'index'));?>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->Html->script(array('/usermgmt/js/ajaxValidation.js?q='.QRDN)); ?>
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'addGroupForm', 'submitButtonId' => 'addGroupSubmitBtn')); ?>
		<?php echo $this->Form->create('UserGroup', array('id'=>'addGroupForm', 'class'=>'form-horizontal')); ?>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Group Name');?></label>
			<div class="controls">
				<?php echo $this->Form->input('name', array('label'=>false, 'div'=>false)); ?>
				<span class='tagline'><?php echo __('for ex. Business User');?></span>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Alias Group Name');?></label>
			<div class="controls">
				<?php echo $this->Form->input('alias_name', array('label'=>false, 'div'=>false)); ?>
				<span class='tagline'><?php echo __('for ex. Business_User (Must not contain space)');?></span>
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
		<?php   if(!isset($this->request->data['UserGroup']['allowRegistration'])) {
					$this->request->data['UserGroup']['allowRegistration']=false;
				} ?>
			<label class="control-label"><?php echo __('Allow Registration');?></label>
			<div class="controls">
				<?php echo $this->Form->input('allowRegistration', array('type'=>'checkbox', 'label'=>false, 'div'=>false)); ?>
			</div>
		</div>
		<div class="um-button-row">
			<?php echo $this->Form->Submit('Add Group', array('class'=>'btn btn-primary', 'id'=>'addGroupSubmitBtn')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
		<div style='padding:5px'><?php echo __('Note: If you add a new group then you should give permissions to this newly created Group.');?></div>
	</div>
</div>