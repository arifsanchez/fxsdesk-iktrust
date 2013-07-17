<div class="login-body">
	<h2><b>REGISTER</b>  or <b><?php echo $this->Html->link('SIGN IN', '/');?></b></h2>

	<?php echo $this->Html->script(array('/usermgmt/js/ajaxValidation.js?q='.QRDN)); ?>
	<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'registerForm', 'submitButtonId' => 'registerSubmitBtn')); ?>
	<?php echo $this->Form->create('User', array('id'=>'registerForm', 'class'=>'')); ?>
	<?php if (count($userGroups) >2) { ?>
	<div class="um-form-row control-group">
		<label class="control-label required"><?php echo __('Group');?></label>
		<div class="controls">
			<?php echo $this->Form->input('user_group_id', array('type' => 'select', 'label'=>false, 'div'=>false)); ?>
		</div>
	</div>
	<?php } ?>
	<div class="email control-group">
		<div class="controls">
			<?php echo $this->Form->input('username', array('label'=>false, 'div'=>false, 'class' => "input-block-level", 'placeholder' => 'Username',)); ?>
		</div>
	</div>
	<div class="email control-group">
		<div class="controls">
			<?php echo $this->Form->input('first_name', array('label'=>false, 'div'=>false, 'class' => "input-block-level", 'placeholder' => 'First Name', )); ?>
		</div>
	</div>
	<div class="email control-group">
		<div class="controls">
			<?php echo $this->Form->input('last_name', array('label'=>false, 'div'=>false, 'class' => "input-block-level", 'placeholder' => 'Last Name', )); ?>
		</div>
	</div>
	<div class="email control-group">
		<div class="controls">
			<?php echo $this->Form->input('email', array('label'=>false, 'div'=>false, 'class' => "input-block-level", 'placeholder' => 'Email', )); ?>
		</div>
	</div>
	<div class="pw control-group">
		<div class="controls">
			<?php echo $this->Form->input('password', array('type'=>'password', 'label'=>false, 'div'=>false, 'class' => "input-block-level", 'placeholder' => 'Password', )); ?>
		</div>
	</div>
	<div class="pw control-group">
		<div class="controls">
			<?php echo $this->Form->input('cpassword', array('type'=>'password', 'label'=>false, 'div'=>false, 'class' => "input-block-level", 'placeholder' => 'Last Name', )); ?>
		</div>
	</div>
	<?php if(USE_RECAPTCHA && PRIVATE_KEY_FROM_RECAPTCHA !="" && PUBLIC_KEY_FROM_RECAPTCHA !="") { ?>
	<div class="um-form-row control-group">
		<?php   $this->Form->unlockField('recaptcha_challenge_field');
				$this->Form->unlockField('recaptcha_response_field'); ?>
		<label class="control-label required"><?php echo __('Prove you\'re not a robot');?></label>
		<div class="controls">
			<?php echo $this->UserAuth->showCaptcha(isset($this->validationErrors['User']['captcha'][0]) ? $this->validationErrors['User']['captcha'][0] : ""); ?>
		</div>
	</div>
	<?php } ?>
	
		<?php echo $this->Form->Submit('Register FX Desk Account', array('div'=>false, 'class'=>'btn btn-primary', 'id'=>'registerSubmitBtn')); ?>
	
	<?php echo $this->Form->end(); ?>

	
</div>
<div class="login-body bodythe center">
		<?php echo $this->element('Usermgmt.provider'); ?>
	</div>


	<style type="text/css">
      .bodythe {
      	height: 100px;

      	padding-left: 30px;
      }
	</style>