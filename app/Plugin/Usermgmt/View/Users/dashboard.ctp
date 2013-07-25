<div class="row-fluid">
	<div class="span12">
		<ul class="tiles">
			<li class="orange high long">
				<a href="<?php echo SITE_URL;?>TraderAccounts/listing"><span class='count'><i class="glyphicon-wallet"></i> 5</span><span class='name'>Trading Accounts</span></a>
			</li>
			<li class="green long">
				<a href="#"><span><i class="icon-money"></i></span><span class='name'>Pro Wallet Funding</span></a>
			</li>
			
			<li class="image">
				<a href="<?php echo SITE_URL;?>myprofile"><img alt="<?php echo h($var['User']['first_name'].' '.$var['User']['last_name']); ?>" src="<?php echo $this->Image->resize('img/'.IMG_DIR, $var['UserDetail']['photo'], 84, null, true) ?>"><span class='name'><?php echo $var['User']['first_name']." ".$var['User']['last_name']; ?></span></a>
			</li>
			<li class="brown long">
				<a href="#"><span><i class="icon-cloud-upload"></i></span><span class='name'>Verification Documents</span></a>
			</li>
			<li class="blue">
				<a href="<?php echo SITE_URL;?>editProfile"><span><i class="icon-cogs"></i></span><span class='name'>Edit Profile</span></a>
			</li>
			<li class="red">
				<a href="#"><span class='count'><i class="icon-envelope"></i> 1</span><span class='name'>IK Mail</span></a>
			</li>
			<li class="darkblue">
				<a href="#"><span><i class="glyphicon-download"></i></span><span class='name'>Downloads</span></a>
			</li>
			<li class="teal long">
				<a href="#"><span class='count'><i class="icon-book"></i></span><span class='name'>Trading Conditions</span></a>
			</li>
			<li class="orange">
				<a href="<?php echo SITE_URL;?>logout"><span><i class="icon-signout"></i></span><span class='name'>Sign out</span></a>
			</li>
		</ul>
	</div>
</div>

<?php 
	#echo pr($var);
?>
			