<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>

<div class="row-fluid">
	<div class="span12">
		<div class="box box-small lightred box-color box-bordered">
			<div class="box-title">
				<h3>
					<i class="icon-money"></i>
					Update Profile
				</h3>
				<div class="actions">
					<a href="<?php echo SITE_URL;?>myprofile" class="btn btn-mini"><i class="icon-user"></i> View My profile</a>
				</div>
			</div>
			<div class="box-content">

				<div class="row-fluid">
					<div class="span6">
						<p>Record Last Modified : <?php echo $var['User']['modified'];?></p>
						<!-- edit Profile block -->
						<?php echo $this->Html->script(array('/usermgmt/js/ajaxValidation.js?q='.QRDN)); ?>
						<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'editProfileForm', 'submitButtonId' => 'editProfileSubmitBtn')); ?>
						<?php echo $this->Form->create('User', array('type' => 'file', 'id'=>'editProfileForm', 'class'=>'form-horizontal')); ?>
						<?php echo $this->Form->hidden('id'); ?>
						<?php echo $this->Form->hidden('UserDetail.id'); ?>
						<?php $changeUserName = (ALLOW_CHANGE_USERNAME) ? false : true; ?>
						<div class="um-form-row control-group">
							<label class="control-label required"><?php echo __('Username');?></label>
							<div class="controls">
								<?php echo $this->Form->input('username', array('label'=>false, 'div'=>false, 'readonly'=>$changeUserName)); ?>
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
							<label class="control-label required"><?php echo __('Gender');?></label>
							<div class="controls">
								<?php echo $this->Form->input('UserDetail.gender', array('label'=>false, 'div'=>false, 'type' => 'select', 'options'=>$gender)); ?>
							</div>
						</div>
						<!--div class="um-form-row control-group">
							<label class="control-label required"><?php echo __('Marital Status');?></label>
							<div class="controls">
								<?php echo $this->Form->input('UserDetail.marital_status', array('label'=>false, 'div'=>false, 'type' => 'select', 'options'=>$marital)); ?>
							</div>
						</div-->
						
						
					</div>
					<div class="span6">
						<div class="um-form-row control-group">
							<label class="control-label"><?php echo __('Birthday');?></label>
							<div class="controls">
								<?php echo $this->Form->input('UserDetail.bday', array('type'=>'text', 'label'=>false, 'div'=>false, 'class'=>'date')); ?>
							</div>
						</div>
						<div class="um-form-row control-group">
							<label class="control-label"><?php echo __('Cellphone');?></label>
							<div class="controls">
								<?php echo $this->Form->input('UserDetail.cellphone', array('label'=>false, 'div'=>false)); ?>
							</div>
						</div>
						<div class="um-form-row control-group">
							<label class="control-label"><?php echo __('Location');?></label>
							<div class="controls">
								<?php echo $this->Form->input('UserDetail.location', array('label'=>false, 'div'=>false)); ?>
							</div>
						</div>
						<div class="um-form-row control-group">
							<label class="control-label"><?php echo __('Photo');?></label>
							<div class="controls">
								<?php echo $this->Form->input('UserDetail.photo', array('label'=>false, 'div'=>false, 'type' => 'file')); ?>
							</div>
						</div>
						<div class="um-form-row control-group">
							<label class="control-label"><?php echo __('Web Page');?></label>
							<div class="controls">
								<?php echo $this->Form->input('UserDetail.web_page', array('label'=>false, 'div'=>false, 'type' => 'text')); ?>
							</div>
						</div>
						<div class="um-button-row">
							<?php echo $this->Form->Submit('Update Profile', array('class'=>'btn btn-primary', 'id'=>'editProfileSubmitBtn')); ?>
						</div>
						<?php echo $this->Form->end(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>