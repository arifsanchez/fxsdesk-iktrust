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
		
		echo "<li class='".(($actionUrl=='Users/dashboard') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Dashboard'), '/dashboard')."</li>";

		/** My Wallet **/
		if($this->UserAuth->HP('Vaults', 'manage')) {

			echo "<li class='".(($actionUrl=='Vaults/manage') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('My Wallet'), array('controller'=>'Vaults', 'action'=>'manage','plugin' =>''))."</li>";
		}

		/** My Account **/
		if($this->UserAuth->HP('TraderAccounts', 'listing')) {
			echo "<li class='".(($actionUrl=='TraderAccounts/listing') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('My Accounts'), array('controller'=>'TraderAccounts', 'action'=>'listing','plugin' =>''))."</li>";
		}

	}
	?>
</ul>