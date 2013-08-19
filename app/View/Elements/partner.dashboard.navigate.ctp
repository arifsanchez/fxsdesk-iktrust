<?php
	$contName = Inflector::camelize($this->params['controller']);
	$actName = $this->params['action'];
	$actionUrl = $contName.'/'.$actName;
	$activeClass='active';
	$inactiveClass='';
?>

<ul class='main-nav'>
<?php
	if($this->UserAuth->isLogged()) {
		
		echo "<li class='".(($actionUrl=='Partners/cabinet') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Cabinet'), array('controller'=>'Partners', 'action'=>'cabinet?me:'.$var['User']['username'],'plugin' =>''))."</li>";

		/** My Wallet **/
		if($this->UserAuth->HP('Partners', 'vault')) {

			echo "<li class='".(($actionUrl=='Partners/vault') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Partner Vault'), array('controller'=>'Partners', 'action'=>'vault?me:'.$var['User']['username'],'plugin' =>''))."</li>";
		}

		/** My Network **/
		if($this->UserAuth->HP('TraderAccounts', 'mynetwork')) {
			echo "<li class='".(($actionUrl=='TraderAccounts/mynetwork') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('My Networks'), array('controller'=>'TraderAccounts', 'action'=>'mynetwork?me:'.$var['User']['username'],'plugin' =>''))."</li>";
		}

	}
	?>
</ul>