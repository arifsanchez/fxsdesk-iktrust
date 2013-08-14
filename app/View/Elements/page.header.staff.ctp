<?php echo $this->Html->script('tarikh_masa'); ?>
<div class="page-header">
	<div class="pull-left">
		<h1>
			<?php if(!empty($page_title)){
				echo "<i class=".$page_title['icon']."></i>&nbsp;";
				echo $page_title['name'];
			} else {
				echo "<i class=\"icon-bar-chart\"></i>&nbsp;";
				echo ucwords(strtolower($this->params['action']));
			};?>
		</h1>
	</div>
	<div class="pull-right">
		<ul class="minitiles">
			<li class='orange' >
				<a data-placement="bottom" title="" rel="tooltip" href="<?php echo SITE_URL;?>partners/cabinet" data-original-title="Partner Cabinet">
					<i class="glyphicon-dashboard"></i>
				</a>
			</li>
		</ul>
		<ul class="stats">
			<li class='lightred'>
				<i class="icon-calendar"></i>
				<div class="details">
					<span class="big" id="tarikh"></span>
					<span id="masa"></span>
				</div>
			</li>
		</ul>
	</div>
</div>