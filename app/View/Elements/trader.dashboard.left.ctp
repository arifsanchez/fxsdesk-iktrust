<div class="subnav">
	<div class="subnav-title">
		<a href="#" class='toggle-subnav'><i class="icon-user-md"></i><span>Personal Details</span></a>
	</div>
	<ul class="subnav-menu">
		<li>
			<a href="<?php echo SITE_URL;?>myprofile?me:<?php echo $var['User']['username'];?>">My Profile</a>
		</li>
		<li>
			<a href="<?php echo SITE_URL;?>editProfile?me:<?php echo $var['User']['username'];?>">Update Profile</a>
		</li>
		<li>
			<a href="<?php echo SITE_URL;?>verifyIdentity?me:<?php echo $var['User']['username'];?>">Verify Identity</a>
		</li>
	</ul>
</div>
<div class="subnav">
	<div class="subnav-title">
		<a href="#" class='toggle-subnav'><i class="icon-money"></i><span>IK Wallet</span></a>
	</div>
	<ul class="subnav-menu">
		<li>
			<a href="<?php echo SITE_URL;?>vaults/manage?me:<?php echo $var['User']['username'];?>">Overview</a>
		</li>
		<li>
			<a href="<?php echo SITE_URL;?>vaults/mywallet_history?me:<?php echo $var['User']['username'];?>">History</a>
		</li>
	</ul>
</div>
<div class="subnav">
	<div class="subnav-title">
		<a href="#" class='toggle-subnav'><i class="icon-medkit"></i><span>IK Mailbox</span></a>
	</div>
	<ul class="subnav-menu">
		<li>
			<a href="<?php echo SITE_URL;?>securityInbox?me:<?php echo $var['User']['username'];?>">Inbox</a>
		</li>
		<li>
			<a href="<?php echo SITE_URL;?>sentSupportRequest?me:<?php echo $var['User']['username'];?>">Request Support</a>
		</li>
	</ul>
</div>