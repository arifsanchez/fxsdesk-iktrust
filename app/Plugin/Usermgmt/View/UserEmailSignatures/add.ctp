<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>

<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Add Signature') ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Back', true), array('action'=>'index'));?>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->Html->script(array('/usermgmt/js/ajaxValidation.js?q='.QRDN)); ?>
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'addSignatureForm', 'submitButtonId' => 'addSignatureSubmitBtn')); ?>
		<?php echo $this->Form->create('UserEmailSignature', array('id'=>'addSignatureForm', 'class'=>'form-horizontal')); ?>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Signature Name');?></label>
			<div class="controls">
				<?php echo $this->Form->input('signature_name', array('type' => 'text', 'label'=>false, 'div'=>false, 'class'=>'span4')); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label"><?php echo __('Email Signature');?></label>
			<div class="controls">
				<?php  echo $this->Ckeditor->textarea('UserEmailSignature.signature', array('type' => 'textarea', 'label' => false, 'div' => false, 'style'=>'height:400px'), array('language'=>'en',
'uiColor'=> '#CCFFCC'), 'standard');?>
			</div>
		</div>
		<div class="um-button-row">
			<?php echo $this->Form->Submit('Add Signature', array('class'=>'btn btn-primary', 'id'=>'addSignatureSubmitBtn')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>