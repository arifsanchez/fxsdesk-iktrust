<?php
	$contName = Inflector::camelize($this->params['controller']);
	$actName = $this->params['action'];
	$actionUrl = $contName.'/'.$actName;
	$activeClass='active';
	$inactiveClass='';
?>

<ul class='main-nav'>
<?php
	if(empty($var)){
		$var['User']['username'] = "SystemError";
	}
	if($this->UserAuth->isLogged()) {
	echo "<li class='".(($actionUrl=='Staffs/backoffice') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Dashboard'), array('controller'=>'Staffs', 'action'=>'backoffice?me:'.$var['User']['username'], 'plugin' => ''))."</li>";
	
		echo "<li class='dropdown'>";
			if($this->UserAuth->HP('Users', 'index')) {
				echo $this->Html->link(__('Users').' <b class="caret"></b>', '#', array('escape'=>false, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'));
			}
			echo "<ul class='dropdown-menu'>";
				if($this->UserAuth->HP('Users', 'addUser')) {
					echo "<li class='".(($actionUrl=='Users/addUser') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Add User'), array('controller'=>'Users', 'action'=>'addUser?me:'.$var['User']['username'], 'plugin'=>'usermgmt'))."</li>";
				}
				if($this->UserAuth->HP('Users', 'index')) {
					echo "<li class='".(($actionUrl=='Users/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('All Users'), array('controller'=>'Users', 'action'=>'index?me:'.$var['User']['username'], 'plugin'=>'usermgmt'))."</li>";
				}
				if($this->UserAuth->HP('Users', 'online')) {
					echo "<li class='".(($actionUrl=='Users/online') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Online Users'), array('controller'=>'Users', 'action'=>'online?me:'.$var['User']['username'], 'plugin'=>'usermgmt'))."</li>";
				}
				if($this->UserAuth->HP('UserGroups', 'addGroup')) {
					echo "<li class='".(($actionUrl=='UserGroups/addGroup') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Add Group'), array('controller'=>'UserGroups?me:'.$var['User']['username'], 'action'=>'addGroup', 'plugin'=>'usermgmt'))."</li>";
				}
				if($this->UserAuth->HP('UserGroups', 'index')) {
					echo "<li class='".(($actionUrl=='UserGroups/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('All Groups'), array('controller'=>'UserGroups', 'action'=>'index?me:'.$var['User']['username'], 'plugin'=>'usermgmt'))."</li>";
				}
			echo "</ul>";
		echo "</li>";
		
		echo "<li class='dropdown'>";
			if($this->UserAuth->HP('UserEmails', 'index')) {
				echo $this->Html->link(__('eMail').' <b class="caret"></b>', '#', array('escape'=>false, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'));
			}
			echo "<ul class='dropdown-menu'>";
				if($this->UserAuth->HP('UserEmails', 'send')) {
					echo "<li class='".(($actionUrl=='UserEmails/send') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Send Mail'), array('controller'=>'UserEmails', 'action'=>'send?me:'.$var['User']['username'], 'plugin'=>'usermgmt'))."</li>";
				}
				if($this->UserAuth->HP('UserEmails', 'index')) {
					echo "<li class='".(($actionUrl=='UserEmails/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('All Mails'), array('controller'=>'UserEmails', 'action'=>'index?me:'.$var['User']['username'], 'plugin'=>'usermgmt'))."</li>";
				}
				if($this->UserAuth->HP('UserEmailTemplates', 'index')) {
					echo "<li class='".(($actionUrl=='UserEmailTemplates/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Email Templates'), array('controller'=>'UserEmailTemplates?me:'.$var['User']['username'], 'action'=>'index', 'plugin'=>'usermgmt'))."</li>";
				}
				if($this->UserAuth->HP('UserEmailSignatures', 'index')) {
					echo "<li class='".(($actionUrl=='UserEmailSignatures/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Email Signatures'), array('controller'=>'UserEmailSignatures?me:'.$var['User']['username'], 'action'=>'index', 'plugin'=>'usermgmt'))."</li>";
				}
			echo "</ul>";
		echo "</li>";
		echo "<li class='dropdown'>";
			if($this->UserAuth->HP('Contents', 'index')) {
				echo $this->Html->link(__('Pages').' <b class="caret"></b>', '#', array('escape'=>false, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'));
			}
			echo "<ul class='dropdown-menu'>";
				if($this->UserAuth->HP('Contents', 'addPage')) {
					echo "<li class='".(($actionUrl=='Contents/addPage') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Add Page'), array('controller'=>'Contents', 'action'=>'addPage?me:'.$var['User']['username'], 'plugin'=>'usermgmt'))."</li>";
				}
				if($this->UserAuth->HP('Contents', 'index')) {
					echo "<li class='".(($actionUrl=='Contents/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('All Pages'), array('controller'=>'Contents', 'action'=>'index?me:'.$var['User']['username'], 'plugin'=>'usermgmt'))."</li>";
				}
			echo "</ul>";
		echo "</li>";

		echo "<li class='dropdown'>";
			if($this->UserAuth->HP('UserSettings', 'index')) {
				echo $this->Html->link(__('SysConfig').' <b class="caret"></b>', '#', array('escape'=>false, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'));
			}
			echo "<ul class='dropdown-menu'>";
				if($this->UserAuth->HP('UserGroupPermissions', 'index')) {
					echo "<li class='".(($actionUrl=='UserGroupPermissions/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Group Permissions'), array('controller'=>'UserGroupPermissions', 'action'=>'index?me:'.$var['User']['username'], 'plugin'=>'usermgmt'))."</li>";
				}
				if($this->UserAuth->HP('UserGroupPermissions', 'subPermissions')) {
					echo "<li class='".(($actionUrl=='UserGroupPermissions/subPermissions') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Subgroup Permissions'), array('controller'=>'UserGroupPermissions', 'action'=>'subPermissions?me:'.$var['User']['username'], 'plugin'=>'usermgmt'))."</li>";
				}
				if($this->UserAuth->HP('UserSettings', 'index')) {
					echo "<li class='".(($actionUrl=='UserSettings/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('All Settings'), array('controller'=>'UserSettings', 'action'=>'index?me:'.$var['User']['username'], 'plugin'=>'usermgmt'))."</li>";
				}
				if($this->UserAuth->HP('Users', 'deleteCache')) {
					echo "<li>".$this->Html->link(__('Delete Cache'), array('controller'=>'Users', 'action'=>'deleteCache?me:'.$var['User']['username'], 'plugin'=>'usermgmt'))."</li>";
				}
			echo "</ul>";
		echo "</li>";
	}
	?>
</ul>