<h1><a href="#"><img src="../img/logo-big.png" alt="" class='retina-ready' width="59" height="49">IK Trust</a></h1>
<div class="login-body">
	<h2>REGISTER</h2>

	<?php echo $this->Html->script(array('/usermgmt/js/ajaxValidation.js?q='.QRDN)); ?>
				<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'registerForm', 'submitButtonId' => 'registerSubmitBtn')); ?>
				<?php echo $this->Form->create('User', array('id'=>'registerForm', 'class'=>'form-horizontal')); ?>
				<?php if (count($userGroups) >2) { ?>
				<div class="um-form-row control-group">
					<label class="control-label required"><?php echo __('Group');?></label>
					<div class="controls">
						<?php echo $this->Form->input('user_group_id', array('type' => 'select', 'label'=>false, 'div'=>false)); ?>
					</div>
				</div>
				<?php } ?>
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
				<div class="um-button-row">
					<?php echo $this->Form->Submit('Sign Up', array('div'=>false, 'class'=>'btn btn-primary', 'id'=>'registerSubmitBtn')); ?>
				</div>
				<?php echo $this->Form->end(); ?>

	<div class="other_provider">
		<?php echo $this->element('Usermgmt.provider'); ?>
	</div>
</div>