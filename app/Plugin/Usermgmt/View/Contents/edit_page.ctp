
<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Edit Page') ?>
		</span>
		<span class="um-panel-title-right">
			<?php $page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1; ?>
			<?php echo $this->Html->link(__('Back', true), array('action'=>'index', 'page'=>$page));?>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->Html->script(array('/usermgmt/js/ajaxValidation.js?q='.QRDN)); ?>
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'editPageForm', 'submitButtonId' => 'editPageSubmitBtn')); ?>
		<?php echo $this->Form->create('Content', array('id'=>'editPageForm', 'class'=>'form-horizontal')); ?>
		<?php echo $this->Form->hidden('id'); ?>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Page Name');?></label>
			<div class="controls">
				<?php echo $this->Form->input('page_name', array('type' => 'text', 'label'=>false, 'div'=>false, 'class'=>'span4')); ?>
				<?php echo __('For ex. Contact Us, About Us'); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Url Name');?></label>
			<div class="controls">
				<?php echo $this->Form->input('url_name', array('type' => 'text', 'label'=>false, 'div'=>false, 'class'=>'span4')); ?>
				<?php echo __('For ex. contactus, contactus.html, aboutus, aboutus.html'); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label"><?php echo __('Page Title');?></label>
			<div class="controls">
				<?php echo $this->Form->input('page_title', array('type' => 'text', 'label'=>false, 'div'=>false, 'class'=>'span4')); ?>
				<?php echo __('For ex. Your Contact Details'); ?>
			</div>
		</div>
		<div class="um-form-row control-group">
			<label class="control-label required"><?php echo __('Page Content');?></label>
			<div class="controls">
				<?php  echo $this->Ckeditor->textarea('Content.page_content', array('type' => 'textarea', 'label' => false, 'div' => false, 'style'=>'height:500px'), array('language'=>'en',
'#EEEEEE'), 'full');?>
			</div>
		</div>
		<div class="um-button-row">
			<?php echo $this->Form->Submit('Save Page', array('class'=>'btn btn-primary', 'id'=>'editPageSubmitBtn')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>