<?php echo $this->Html->script(array('/usermgmt/js/ajaxValidation.js?q='.QRDN)); ?>
<?php echo $this->element('Usermgmt.ajax_validation', array('formId' => 'cloginForm', 'submitButtonId' => 'cloginSubmitBtn')); ?>
<div style='padding:10px'>
	<?php echo $this->Form->create('User', array('url'=>array('controller' => 'users', 'action' => 'login', 'plugin'=>'usermgmt'), 'id'=>'cloginForm')); ?>
	<?php echo $this->Form->input('email', array('label' => false, 'div' => false, 'placeholder'=>__('Email / Username'), 'title'=>__('Email / Username'))); ?><br/>
	<?php echo $this->Form->input('password', array('type'=>'password', 'label' => false, 'div' => false, 'placeholder'=>__('Password'), 'title'=>__('Password'))); ?><br/>
	<?php if(!isset($this->request->data['User']['remember'])) { $this->request->data['User']['remember']=true; } ?>
	<?php echo $this->Form->input('remember', array('type'=>'checkbox', 'label' => false, 'div' => false, 'title'=>__('Remember Me'), 'style'=>'margin-top:0'));?>
	<?php echo __('Remember Me');?><br/><br/>
	<?php echo $this->Form->Submit(__('Sign In'), array('id'=>'cloginSubmitBtn', 'class'=>'btn btn-primary'));?>
	<?php echo $this->Form->end(); ?>
	<?php echo $this->Html->link(__('Register'), '/register', array()); ?><br/>
	<?php echo $this->Html->link(__('Forgot Password?'), '/forgotPassword', array()); ?><br/>
	<?php echo $this->Html->link(__('Email Verification'), '/emailVerification', array()); ?>
</div>