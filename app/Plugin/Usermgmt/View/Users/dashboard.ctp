<div class="row-fluid">
	<div class="span12">
		<ul class="tiles">
			<li class="orange high long">
				<a href="#"><span class='count'><i class="glyphicon-wallet"></i> 5</span><span class='name'>Trading Accounts</span></a>
			</li>
			<li class="lime">
				<a href="#"><span><i class="icon-dashboard"></i></span><span class='name'>Dashboard</span></a>
			</li>
			<li class="red">
				<a href="#"><span class='count'><i class="icon-envelope"></i> 1</span><span class='name'>IK Mails</span></a>
			</li>
			<li class="blue">
				<a href="#"><span><i class="icon-cogs"></i></span><span class='name'>Edit Profile</span></a>
			</li>
			<li class="image">
				<a href="#"><img alt="<?php echo h($var['User']['first_name'].' '.$var['User']['last_name']); ?>" src="<?php echo $this->Image->resize('img/'.IMG_DIR, $var['UserDetail']['photo'], 84, null, true) ?>"><span class='name'><?php echo $var['User']['first_name']." ".$var['User']['last_name']; ?></span></a>
			</li>
			<li class="teal long">
				<a href="#"><span class='count'><i class="icon-cloud-upload"></i> 12</span><span class='name'>Verification Documents</span></a>
			</li>
			<li class="green long">
				<a href="#"><span><i class="icon-money"></i></span><span class='name'>Account Funding</span></a>
			</li>
			<li class="brown">
				<a href="#"><span class='count'><i class="icon-bolt"></i> 3</span><span class='name'>Warnings</span></a>
			</li>
			<li class="teal long">
				<a href="#"><span class='count'><i class="icon-cloud-upload"></i> 12</span><span class='name'>Verification Documents</span></a>
			</li>
			<li class="orange">
				<a href="#"><span><i class="icon-signout"></i></span><span class='name'>Sign out</span></a>
			</li>
		</ul>
	</div>
</div>

<?php 
	#echo pr($var);
?>
			