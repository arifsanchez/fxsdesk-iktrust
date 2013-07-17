
<?php
$contName = Inflector::camelize($this->params['controller']);
$actName = $this->params['action'];
$actionUrl = $contName.'/'.$actName;
$activeClass='active';
$inactiveClass='';
?>
<div class="dashboard-menu">
	<div class="navbar">
		<div class="navbar-inner">
			<ul class="nav nav-pills">
			<?php
				echo "<li class='".(($actionUrl=='Users/dashboard') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Dashboard'), '/dashboard')."</li>";
				if($this->UserAuth->isLogged()) {
					echo "<li class='dropdown'>";
						echo $this->Html->link(__('Users').' <b class="caret"></b>', '#', array('escape'=>false, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'));
						echo "<ul class='dropdown-menu'>";
							if($this->UserAuth->HP('Users', 'addUser')) {
								echo "<li class='".(($actionUrl=='Users/addUser') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Add User'), array('controller'=>'Users', 'action'=>'addUser', 'plugin'=>'usermgmt'))."</li>";
							}
							if($this->UserAuth->HP('Users', 'index')) {
								echo "<li class='".(($actionUrl=='Users/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('All Users'), array('controller'=>'Users', 'action'=>'index', 'plugin'=>'usermgmt'))."</li>";
							}
							if($this->UserAuth->HP('Users', 'online')) {
								echo "<li class='".(($actionUrl=='Users/online') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Online Users'), array('controller'=>'Users', 'action'=>'online', 'plugin'=>'usermgmt'))."</li>";
							}
						echo "</ul>";
					echo "</li>";
					echo "<li class='dropdown'>";
						echo $this->Html->link(__('Groups').' <b class="caret"></b>', '#', array('escape'=>false, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'));
						echo "<ul class='dropdown-menu'>";
							if($this->UserAuth->HP('UserGroups', 'addGroup')) {
								echo "<li class='".(($actionUrl=='UserGroups/addGroup') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Add Group'), array('controller'=>'UserGroups', 'action'=>'addGroup', 'plugin'=>'usermgmt'))."</li>";
							}
							if($this->UserAuth->HP('UserGroups', 'index')) {
								echo "<li class='".(($actionUrl=='UserGroups/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('All Groups'), array('controller'=>'UserGroups', 'action'=>'index', 'plugin'=>'usermgmt'))."</li>";
							}
						echo "</ul>";
					echo "</li>";
					echo "<li class='dropdown'>";
						echo $this->Html->link(__('Admin').' <b class="caret"></b>', '#', array('escape'=>false, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'));
						echo "<ul class='dropdown-menu'>";
							if($this->UserAuth->HP('UserGroupPermissions', 'index')) {
								echo "<li class='".(($actionUrl=='UserGroupPermissions/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Group Permissions'), array('controller'=>'UserGroupPermissions', 'action'=>'index', 'plugin'=>'usermgmt'))."</li>";
							}
							if($this->UserAuth->HP('UserGroupPermissions', 'subPermissions')) {
								echo "<li class='".(($actionUrl=='UserGroupPermissions/subPermissions') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Subgroup Permissions'), array('controller'=>'UserGroupPermissions', 'action'=>'subPermissions', 'plugin'=>'usermgmt'))."</li>";
							}
							if($this->UserAuth->HP('UserSettings', 'index')) {
								echo "<li class='".(($actionUrl=='UserSettings/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('All Settings'), array('controller'=>'UserSettings', 'action'=>'index', 'plugin'=>'usermgmt'))."</li>";
							}
							if($this->UserAuth->HP('Users', 'deleteCache')) {
								echo "<li>".$this->Html->link(__('Delete Cache'), array('controller'=>'Users', 'action'=>'deleteCache', 'plugin'=>'usermgmt'))."</li>";
							}
						echo "</ul>";
					echo "</li>";
					echo "<li class='dropdown'>";
						echo $this->Html->link(__('Mail').' <b class="caret"></b>', '#', array('escape'=>false, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'));
						echo "<ul class='dropdown-menu'>";
							if($this->UserAuth->HP('UserEmails', 'send')) {
								echo "<li class='".(($actionUrl=='UserEmails/send') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Send Mail'), array('controller'=>'UserEmails', 'action'=>'send', 'plugin'=>'usermgmt'))."</li>";
							}
							if($this->UserAuth->HP('UserEmails', 'index')) {
								echo "<li class='".(($actionUrl=='UserEmails/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('All Mails'), array('controller'=>'UserEmails', 'action'=>'index', 'plugin'=>'usermgmt'))."</li>";
							}
							if($this->UserAuth->HP('UserContacts', 'index')) {
								echo "<li class='".(($actionUrl=='UserContacts/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Contact Enquiries'), array('controller'=>'UserContacts', 'action'=>'index', 'plugin'=>'usermgmt'))."</li>";
							}
							if($this->UserAuth->HP('UserEmailTemplates', 'index')) {
								echo "<li class='".(($actionUrl=='UserEmailTemplates/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Email Templates'), array('controller'=>'UserEmailTemplates', 'action'=>'index', 'plugin'=>'usermgmt'))."</li>";
							}
							if($this->UserAuth->HP('UserEmailSignatures', 'index')) {
								echo "<li class='".(($actionUrl=='UserEmailSignatures/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Email Signatures'), array('controller'=>'UserEmailSignatures', 'action'=>'index', 'plugin'=>'usermgmt'))."</li>";
							}
						echo "</ul>";
					echo "</li>";
					echo "<li class='dropdown'>";
						echo $this->Html->link(__('Pages').' <b class="caret"></b>', '#', array('escape'=>false, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'));
						echo "<ul class='dropdown-menu'>";
							if($this->UserAuth->HP('Contents', 'addPage')) {
								echo "<li class='".(($actionUrl=='Contents/addPage') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Add Page'), array('controller'=>'Contents', 'action'=>'addPage', 'plugin'=>'usermgmt'))."</li>";
							}
							if($this->UserAuth->HP('Contents', 'index')) {
								echo "<li class='".(($actionUrl=='Contents/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('All Pages'), array('controller'=>'Contents', 'action'=>'index', 'plugin'=>'usermgmt'))."</li>";
							}
						echo "</ul>";
					echo "</li>";
					echo "<li class='dropdown'>";
						echo $this->Html->link(__('My Account').' <b class="caret"></b>', '#', array('escape'=>false, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'));
						echo "<ul class='dropdown-menu'>";
							if($this->UserAuth->HP('Users', 'myprofile')) {
								echo "<li class='".(($actionUrl=='Users/myprofile') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('View Profile'), array('controller'=>'Users', 'action'=>'myprofile', 'plugin'=>'usermgmt'))."</li>";
							}
							if($this->UserAuth->HP('Users', 'editProfile')) {
								echo "<li class='".(($actionUrl=='Users/editProfile') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Edit Profile'), array('controller'=>'Users', 'action'=>'editProfile', 'plugin'=>'usermgmt'))."</li>";
							}
							if($this->UserAuth->HP('Users', 'changePassword')) {
								echo "<li class='".(($actionUrl=='Users/changePassword') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Change Password'), array('controller'=>'Users', 'action'=>'changePassword', 'plugin'=>'usermgmt'))."</li>";
							}
							if($this->UserAuth->HP('Users', 'deleteAccount') && ALLOW_DELETE_ACCOUNT) {
								echo "<li>".$this->Html->link(__('Delete Account'), array('controller'=>'Users', 'action'=>'deleteAccount', 'plugin'=>'usermgmt'), array('escape' => false, 'confirm' => __('Are you sure you want to delete your account?')))."</li>";
							}
						echo "</ul>";
					echo "</li>";
				}
				echo "<li class='".(($actionUrl=='UserContacts/contactUs') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__("Contact Us"), '/contactUs')."</li>";
				if($this->UserAuth->isLogged()) {
					echo "<li>".$this->Html->link(__('Sign Out'), '/logout')."</li>";
				} else {
					echo "<li class='".(($actionUrl=='Users/login') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Sign In'), '/login')."</li>";
				} ?>
			</ul>
		</div>
	</div>
</div>