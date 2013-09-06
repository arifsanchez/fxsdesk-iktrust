<style>
	#PartnerCariTraccForm{
		margin: 0 !important;
	}
</style>
<?php echo $this->Form->create('Partner', array('action' => 'cariTracc'), array('class' => 'form-search form-horizontal pull-right'));
	echo "<div class='controls'><div class='input-prepend'>";
	echo $this->Form->input('tracc_no', array(
		'label' => false,
		'data-rule-required' => 'true',
		'data-rule-number' => 'true',
		'placeholder' => 'Trading Account No',
		'class' => 'input-large',
		'div' => false,
		'after' => "<span class='add-on'><i class='icon-search'></i></span>"
	));
	echo "</div></div>";
	echo $this->Form->end();
?>