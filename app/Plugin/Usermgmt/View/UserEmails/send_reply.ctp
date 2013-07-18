<?php echo $this->element('Usermgmt.dashboard'); ?>
<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Send Reply to').' '.$name; ?>
		</span>
		<span class="um-panel-title-right">
			<?php $page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1; ?>
			<?php echo $this->Html->link(__('Back', true), array('controller'=>'UserContacts', 'action'=>'index', 'page'=>$page));?>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->Html->script(array('/usermgmt/js/ajaxValidation.js?q='.QRDN)); ?>
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'sendMailForm', 'submitButtonId' => 'sendMailSubmitBtn')); ?>
		<?php echo $this->Form->create('UserEmail', array('id'=>'sendMailForm', 'class'=>'form-horizontal')); ?>
		<?php
			if(!isset($this->request->data['UserEmail']['to'])) {
				$this->request->data['UserEmail']['to'] = $email;
			}
		?>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('To');?></label>
			<div class="controls">
				<?php echo $this->Form->input('to', array('type' => 'text', 'label' => false, 'div' => false, 'class'=>'span4'));?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label"><?php echo __('CC To');?></label>
			<div class="controls">
				<?php echo $this->Form->input('cc_to', array('type'=>'text', 'label'=>false, 'div'=>false, 'class'=>'span4')); ?>
				<span class='tagline'><?php echo __('multiple emails comma separated');?></span>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('From Name');?></label>
			<div class="controls">
				<?php echo $this->Form->input('from_name', array('label'=>false, 'div'=>false, 'class'=>'span4')); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('From Email');?></label>
			<div class="controls">
				<?php echo $this->Form->input('from_email', array('label'=>false, 'div'=>false, 'class'=>'span4')); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label"><?php echo __('Select Template');?></label>
			<div class="controls">
				<?php echo $this->Form->input('template', array('div'=>false, 'label'=>false, 'options'=>$templates, 'autocomplete'=>'off')); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label"><?php echo __('Select Signature');?></label>
			<div class="controls">
				<?php echo $this->Form->input('signature', array('div'=>false, 'label'=>false, 'options'=>$signatures, 'autocomplete'=>'off')); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Subject');?></label>
			<div class="controls">
				<?php echo $this->Form->input('subject', array('label'=>false, 'div'=>false, 'class'=>'span4')); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Message');?></label>
			<div class="controls">
				<?php  echo $this->Ckeditor->textarea('UserEmail.message', array('type' => 'textarea', 'label' => false, 'div' => false, 'style'=>'height:400px', 'class'=>'span6'), array('language'=>'en', 'uiColor'=> '#EEEEEE'), 'full');?>
			</div>
		</div>
		<div class="um-button-row">
			<?php echo $this->Form->Submit('Next', array('class'=>'btn btn-primary', 'id'=>'sendMailSubmitBtn')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>