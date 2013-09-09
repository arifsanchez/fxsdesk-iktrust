<style>
	#PartnerCariClientForm{
		margin: 0 !important;
	}
</style>
<?php echo $this->Form->create('Partner', array('action' => 'cariClient'), array('class' => 'form-search form-horizontal pull-right'));
	echo "<div class='controls'><div class='input-prepend'>";
	echo $this->Form->input('email', array(
		'label' => false,
		'data-rule-required' => 'true',
		'data-rule-email' => 'true',
		'placeholder' => 'Client Email',
		'class' => 'input-large',
		'div' => false,
		'after' => "<span class='add-on'><i class='icon-search'></i></span>"
	));
	echo "</div></div>";
	echo $this->Form->end();
?>