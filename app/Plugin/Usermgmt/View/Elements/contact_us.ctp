<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>
<?php echo $this->Html->script(array('/usermgmt/js/ajaxValidation.js?q='.QRDN)); ?>
<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'contactForm', 'submitButtonId' => 'contactSubmitBtn')); ?>
<div style='padding:10px'>
	<?php echo $this->Form->create('UserContact', array('url'=>array('controller' => 'user_contacts', 'action' => 'contactUs', 'plugin'=>'usermgmt'), 'id'=>'contactForm')); ?>
	<?php echo $this->Form->input('name', array('label' => false, 'div' => false, 'placeholder'=>__('Name'), 'title'=>__('Name'))); ?><br/>
	<?php echo $this->Form->input('email', array('label' => false, 'div' => false, 'placeholder'=>__('Email'), 'title'=>__('Email'))); ?><br/>
	<?php echo $this->Form->input('phone', array('label' => false, 'div' => false, 'placeholder'=>__('Contact No'), 'title'=>__('Contact No'))); ?><br/>
	<?php echo $this->Form->textarea('requirement', array('label' => false, 'div' => false, 'placeholder'=>__('Requirement'), 'title'=>__('Requirement'))); ?><br/>
	<?php
		if(USE_RECAPTCHA && PRIVATE_KEY_FROM_RECAPTCHA !="" && PUBLIC_KEY_FROM_RECAPTCHA !="") {
			$this->Form->unlockField('recaptcha_challenge_field');
			$this->Form->unlockField('recaptcha_response_field');
			echo $this->UserAuth->showCaptcha(isset($this->validationErrors['UserContact']['captcha'][0]) ? $this->validationErrors['UserContact']['captcha'][0] : "");
			echo "<br/>";
		} ?>
	<?php echo $this->Form->Submit(__('Submit'), array('id'=>'contactSubmitBtn', 'class'=>'btn btn-primary')); ?>
	<?php echo $this->Form->end(); ?>
</div>