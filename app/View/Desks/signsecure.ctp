<h2><b>SIGN IN</b> or <b><?php echo $this->Html->link('SIGN UP', '/register');?></b></h2>

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