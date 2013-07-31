

<h2><b>SIGN IN</b></b></h2>

<?php 
	echo $this->Html->script(array('/usermgmt/js/ajaxValidation.js?q='.QRDN));
	echo $this->element('Usermgmt.ajax_validation', array('formId' => 'loginForm', 'submitButtonId' => 'loginSubmitBtn'));
	echo $this->Form->create(null, array('url'=>'/usermgmt/users/login')); 
?>
	<div class="control-group">
		<div class="email controls">
			<input id="UserEmail" type="text" name='data[User][email]' placeholder="Email address" class='input-block-level' data-rule-required="true" data-rule-email="true">
		</div>
	</div>
	<div class="control-group">
		<div class="pw controls">
			<input id="UserPassword" type="password" name="data[User][password]" placeholder="Password" class='input-block-level' data-rule-required="true">
		</div>
	</div>
	<div class="submit">
		<?php if(!isset($this->request->data['User']['remember'])) {
			$this->request->data['User']['remember']=true;
		} ?>
		<div class="remember">
			<input type="checkbox" name="data[User][remember]" class='icheck-me' data-skin="square" data-color="red" id="remember"> <label for="remember">Remember me</label>
		</div>
	</div>
	<div class="submit">
		<?php echo $this->Form->Submit('Sign In', array('div'=>false, 'class'=>'btn btn-red', 'id'=>'loginSubmitBtn')); ?>
		<?php echo $this->Html->link(__('Forgot Password?'), '/forgotPassword', array('class'=>'right btn btn-blue')); ?>
		<?php echo $this->Html->link(__('Email Verification'), '/emailVerification', array('class'=>'right btn btn-satblue')); ?>
	</div>
<?php echo $this->Form->end(); ?>
<hr>
<h2><b>SOCIAL SIGN IN</b></b></h2>
<blockquote>Login / register using your favourite social profile</blockquote>
<div class="login-body bodythe">
	<?php echo $this->element('Usermgmt.provider'); ?>
</div>


<style type="text/css">
  .bodythe {
  	height: 132px;
  	padding-left: 30px;
  }
  .btn {
  	font-size: small;
    margin: 3px;
  }
</style>
