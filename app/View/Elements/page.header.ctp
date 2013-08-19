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
				<a data-placement="bottom" title="" rel="tooltip" href="<?php echo SITE_URL;?>dashboard?me:<?php echo $var['User']['username'];?>" data-original-title="Dashboard">
					<i class="glyphicon-dashboard"></i>
				</a>
			</li>
			<li class='blue' >
				<a data-placement="bottom" title="" rel="tooltip" href="<?php echo SITE_URL;?>TraderAccounts/listing?me:<?php echo $var['User']['username'];?>" data-original-title="Trading Accounts">
					<i class="glyphicon-wallet"></i>
				</a>
			</li>
			<li class='satgreen' >
				<a data-placement="bottom" title="" rel="tooltip" href="<?php echo SITE_URL;?>Vaults/manage?me:<?php echo $var['User']['username'];?>" data-original-title="My Wallet">
					<i class="icon-money"></i>
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

<!--div class="breadcrumbs">
	<ul>
		<li>
			<a href="more-login.html">Home</a>
			<i class="icon-angle-right"></i>
		</li>
		<li>
			<a href="more-files.html">Traders</a>
			<i class="icon-angle-right"></i>
		</li>
		<li>
			<a href="more-blank.html">Dashboard</a>
		</li>
	</ul>
	<div class="close-bread">
		<a href="#"><i class="icon-remove"></i></a>
	</div>
</div-->