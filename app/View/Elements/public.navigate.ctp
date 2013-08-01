<?php
	$contName = Inflector::camelize($this->params['controller']);
	$actName = $this->params['action'];
	$actionUrl = $contName.'/'.$actName;
	$activeClass='active';
	$inactiveClass='';
?>

<ul class='main-nav'>
<?php
	echo "<li class='".(($actionUrl=='Users/login') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Sign In'), '/login')."</li>";
?>
</ul>