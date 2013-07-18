<?php #echo $this->element('Usermgmt.dashboard'); ?>
<div class="um-panel">
	<div class="um-panel-header">
		<span class="um-panel-title">
			<?php echo __('Add Page') ?>
		</span>
		<span class="um-panel-title-right">
			<?php echo $this->Html->link(__('Back', true), array('action'=>'index'));?>
		</span>
	</div>
	<div class="um-panel-content">
		<?php echo $this->Html->script(array('/usermgmt/js/ajaxValidation.js?q='.QRDN)); ?>
		<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'addPageForm', 'submitButtonId' => 'addPageSubmitBtn')); ?>
		<?php echo $this->Form->create('Content', array('id'=>'addPageForm', 'class'=>'form-horizontal')); ?>
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
				 <?php  echo $this->Ckeditor->textarea('Content.page_content', array('type' => 'textarea', 
					'label' => false, 'div' => false, 'style'=>'height:500px', 'class' =>'span10'), array('language'=>'en',
					'uiColor'=> '#EEEEEE'), 'standard');?> 
			</div>
		</div>
		<div class="um-button-row">
			<?php echo $this->Form->Submit('Add Page', array('class'=>'btn btn-primary', 'id'=>'addPageSubmitBtn')); ?>
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</div>