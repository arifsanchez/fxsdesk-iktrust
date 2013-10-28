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
		
		echo "<li class='".(($actionUrl=='Exchanger/wallet') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Wallet'), array('controller'=>'Exchangers', 'action'=>'wallet?me:'.$var['User']['username'],'plugin' =>''))."</li>";

		/** My Wallet **/
		if($this->UserAuth->HP('Partners', 'vault')) {

			echo "<li class='".(($actionUrl=='Partners/vault') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Partner Vault'), array('controller'=>'Partners', 'action'=>'vault?me:'.$var['User']['username'],'plugin' =>''))."</li>";
		}

		/** Partner Network **/
		if($this->UserAuth->HP('Partners', 'mynetwork')) {
			echo "<li class='dropdown'>";
				echo $this->Html->link(__('Partner Network').' <b class="caret"></b>', '#', array('escape'=>false, 'class'=>'dropdown-toggle', 'data-toggle'=>'dropdown'));

				echo "<ul class='dropdown-menu'>";
					if($this->UserAuth->HP('Partners', 'myclient')) {
						echo "<li class='".(($actionUrl=='Partners/myclient') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Clients'), array('controller'=>'Partners', 'action'=>'myclient?me:'.$var['User']['username'], 'plugin'=>''))."</li>";
					}

					if($this->UserAuth->HP('Partners', 'mynetwork')) {
						echo "<li class='".(($actionUrl=='Partners/mynetwork') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Accounts'), array('controller'=>'Partners', 'action'=>'mynetwork?me:'.$var['User']['username'], 'plugin'=>''))."</li>";
					}

					if($this->UserAuth->HP('Partners', 'myagent')) {
						echo "<li class='".(($actionUrl=='Partners/myagent') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Agents'), array('controller'=>'Partners', 'action'=>'myagent?me:'.$var['User']['username'], 'plugin'=>''))."</li>";
					}

				echo "</ul>";
			echo "</li>";
		}



	}
	?>
</ul>