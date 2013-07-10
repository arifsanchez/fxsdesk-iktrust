<h1><a href="#"><img src="../img/logo-big.png" alt="" class='retina-ready' width="59" height="49">IK Trust</a></h1>
<div class="login-body">
	<h2>SIGN IN or SIGN UP</h2>

	<?php 
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
			<input id="cloginSubmitBtn" type="submit" value="Sign me in" class='btn btn-primary'>
		</div>
	<?php echo $this->Form->end(); ?>

	<div class="forget">
		<a href="/forgotPassword"><span>Forgot password?</span></a>
	</div>
</div>