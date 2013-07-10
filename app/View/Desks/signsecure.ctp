<h1><a href="#"><img src="../img/logo-big.png" alt="" class='retina-ready' width="59" height="49">IK Trust</a></h1>
<div class="login-body">
	<h2>SIGN IN</h2>

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
			<div class="remember">
				<input type="checkbox" name="remember" class='icheck-me' data-skin="square" data-color="blue" id="remember"> <label for="remember">Remember me</label>
			</div>
			<input id="cloginSubmitBtn" type="submit" value="Sign me in" class='btn btn-primary'>
		</div>
	<?php echo $this->Form->end(); ?>
	<div class="forget">
		<a href="#"><span>Forgot password?</span></a>
	</div>
	
</div>