<?php #https://github.com/arifsanchez/usermanagement_plugin ;?>
<div class="row">
	<div class="um-panel span6 offset3">
		<div class="um-panel-header">
			<span class="um-panel-title">
				<?php echo __('Reset Password') ?>
			</span>
		</div>
		<div class="um-panel-content">
			<?php echo $this->Form->create('User', array('class'=>'form-horizontal')); ?>
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
				<?php   if (!isset($ident)) { $ident=''; }
						if (!isset($activate)) { $activate=''; } ?>
				<?php echo $this->Form->hidden('ident', array('value'=>$ident)); ?>
				<?php echo $this->Form->hidden('activate', array('value'=>$activate)); ?>
				<?php echo $this->Form->Submit('Save New Password', array('div'=>false, 'class'=>'btn btn-primary')); ?>
			</div>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>
</div>