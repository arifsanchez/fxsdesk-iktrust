<div class="row-fluid">
	<div class="span12">
		<ul class="tiles">
			<li class="green high long">
				<a href="<?php echo SITE_URL;?>Partners/vault"><span><i class="icon-money"></i></span><span class='name'>Manage IK Wallet</span></a>
			</li>

			<li class="lightgrey long">
				<a href="<?php echo SITE_URL;?>TraderAccounts/mynetwork"><span class='count'><i class="icon-group"></i><span class='name'>My Networks</span></a>
			</li>
			
			<li class="image">
				<a href="<?php echo SITE_URL;?>myprofile"><img alt="<?php echo h($var['User']['first_name'].' '.$var['User']['last_name']); ?>" src="<?php echo $this->Image->resize('img/'.IMG_DIR, $var['UserDetail']['photo'], 84, null, true) ?>"><span class='name'><?php echo $var['User']['first_name']; ?></span></a>
			</li>
			<li class="brown long">
				<a href="<?php echo SITE_URL;?>Traders/verifyIdentity"><span><i class="icon-cloud-upload"></i></span><span class='name'>Verification Documents</span></a>
			</li>
			<li class="satblue">
				<a href="<?php echo SITE_URL;?>editProfile"><span><i class="icon-cogs"></i></span><span class='name'>Edit Profile</span></a>
			</li>
			<li class="red long">
				<a href="<?php echo SITE_URL;?>Traders/securityInbox"><span class='count'><i class="icon-envelope"></i></span><span class='name'>Security Mail</span></a>
			</li>
			<li class="darkblue">
				<a href="<?php echo SITE_URL;?>contents/downloads"><span><i class="glyphicon-download"></i></span><span class='name'>Downloads</span></a>
			</li>
			<li class="satblue">
				<a href="<?php echo SITE_URL;?>#"><span class='count'><i class="icon-book"></i></span><span class='name'>Marketing Tools</span></a>
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
			