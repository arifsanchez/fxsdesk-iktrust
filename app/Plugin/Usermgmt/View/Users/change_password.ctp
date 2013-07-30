<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>
<div class="row-fluid">
	<div class="span12">
		<div class="box box-small lightred box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-lock"></i>
					Update Password
				</h3>
				<div class="actions">
					
				</div>
			</div>
			<div class="box-content">
				<?php echo $this->Form->create('User', array('class'=>'form-horizontal')); ?>
				<?php if(!$this->Session->check('UserAuth.FacebookChangePass') && !$this->Session->check('UserAuth.TwitterChangePass') && !$this->Session->check('UserAuth.GmailChangePass') && !$this->Session->check('UserAuth.LinkedinChangePass') && !$this->Session->check('UserAuth.FoursquareChangePass') && !$this->Session->check('UserAuth.YahooChangePass')){ ?>
				<div class="um-form-row control-group">
					<label class="control-label required"><?php echo __('Old Password');?></label>
					<div class="controls">
						<?php echo $this->Form->input('oldpassword', array('type'=>'password', 'label'=>false, 'div'=>false)); ?>
					</div>
				</div>
				<?php } ?>
				<?php if($this->Session->check('UserAuth.TwitterChangePass') || $this->Session->check('UserAuth.LinkedinChangePass')){ ?>
				<div class="um-form-row control-group">
					<label class="control-label required"><?php echo __('Email');?></label>
					<div class="controls">
						<?php echo $this->Form->input('email', array('label'=>false, 'div'=>false)); ?>
						<?php
							if(($this->Session->check('UserAuth.TwitterChangePass') || $this->Session->check('UserAuth.LinkedinChangePass')) && isset($this->validationErrors['User']['email']) && $this->validationErrors['User']['email'][0]==__('This email is already registered')) {
								echo __('If this email is yours please verify');
								echo $this->Form->Submit(__('Verify'), array('div'=>false, 'name'=>'verify', 'class'=>'btn'));
								if($this->Session->check('UserAuth.EmailVerifyCode')) {
									echo __('Verification Code');
									echo $this->Form->input('emailVerifyCode', array('label' => false, 'div'=> false, 'style'=>'width:50px'));
								}
							}
						?>
					</div>
				</div>
				<?php } ?>
				<div class="um-form-row control-group">
					<label class="control-label required"><?php echo __('New Password');?></label>
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
					<?php echo $this->Form->Submit('Change Password', array('div'=>false, 'class'=>'btn btn-primary')); ?>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>