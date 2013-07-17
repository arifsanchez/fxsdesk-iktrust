<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>IK TRUST | FXS DESK</title>

	<?php
	#CSS
		#Bootstrap
		echo $this->Html->css('bootstrap.min.css?q='.QRDN);
		#Bootstrap responsive
		echo $this->Html->css('bootstrap-responsive.min.css?q='.QRDN);
		#jQuery UI
		echo $this->Html->css('plugins/jquery-ui/smoothness/jquery-ui.css?q='.QRDN);
		echo $this->Html->css('plugins/jquery-ui/smoothness/jquery.ui.theme.css?q='.QRDN);
		#Theme CSS
		echo $this->Html->css('style.css?q='.QRDN);
		#Color CSS
		echo $this->Html->css('themes.css?q='.QRDN);

	#JS
		#jQuery
		echo $this->Html->script('jquery.min.js?q='.QRDN);
		#jQuery UI
		echo $this->Html->script('plugins/jquery-ui/jquery.ui.core.min.js?q='.QRDN);
		echo $this->Html->script('plugins/jquery-ui/jquery.ui.widget.min.js?q='.QRDN);
		echo $this->Html->script('plugins/jquery-ui/jquery.ui.mouse.min.js?q='.QRDN);
		echo $this->Html->script('plugins/jquery-ui/jquery.ui.resizable.min.js?q='.QRDN);
		echo $this->Html->script('plugins/jquery-ui/jquery.ui.sortable.min.js?q='.QRDN);
		echo $this->Html->script('plugins/jquery-ui/jquery.ui.datepicker.min.js?q='.QRDN);

		#Nice Scroll
		echo $this->Html->script('plugins/nicescroll/jquery.nicescroll.min.js?q='.QRDN);

		#Slim Scroll
		echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js?q='.QRDN);

		#Bootstrap
		echo $this->Html->script('bootstrap.min.js?q='.QRDN);

		#Sparkline
		echo $this->Html->script('plugins/sparklines/jquery.sparklines.min.js?q='.QRDN);

		#Form
		echo $this->Html->script('plugins/form/jquery.form.min.js?q='.QRDN);

		#Notify
		echo $this->Html->script('plugins/gritter/jquery.gritter.min.js?q='.QRDN);

		#Theme Framework
		echo $this->Html->script('eakroko.min.js?q='.QRDN);

		#Theme Scripts
		echo $this->Html->script('application.min.js?q='.QRDN);


	?>

	<!--[if lte IE 9]>
		<?php echo $this->Html->script('plugins/placeholder/jquery.placeholder.min.js?q='.QRDN); ?>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
	
	<?php
		#FAVicon
		echo $this->Html->meta(
		    ''.SITE_URL.'img/fxs-favicon.png',
		    ''.SITE_URL.'img/fxs-favicon.png',
		    array('type' => 'icon')
		);
	?>
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo SITE_URL;?>/img/fxs-2--144px.png" />

</head>

<body class="theme-lightred" data-layout-sidebar="fixed" data-layout-topbar="fixed">
	<div id="navigation">
		<div class="container-fluid">
			<a href="#" id="brand">IK TRUST</a>
			<a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>

			<?php echo $this->element('staff.dashboard.navigate');?>
			
			<div class="user">
				<ul class="icon-nav">
					<li class='dropdown colo'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-tint"></i></a>
						<ul class="dropdown-menu pull-right theme-colors">
							<li class="subtitle">
								Layout Colors
							</li>
							<li>
								<span class='red'></span>
								<span class='orange'></span>
								<span class='green'></span>
								<span class="brown"></span>
								<span class="blue"></span>
								<span class='lime'></span>
								<span class="teal"></span>
								<span class="purple"></span>
								<span class="pink"></span>
								<span class="magenta"></span>
								<span class="grey"></span>
								<span class="darkblue"></span>
								<span class="lightred"></span>
								<span class="lightgrey"></span>
								<span class="satblue"></span>
								<span class="satgreen"></span>
							</li>
						</ul>
					</li>
					<li class='dropdown language-select'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><img src="<?php echo SITE_URL; ?>img/demo/flags/us.gif" alt=""><span> English</span></a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="#"><img src="<?php echo SITE_URL; ?>img/demo/flags/my.gif" alt=""><span> Bahasa Malaysia</span></a>
							</li>
							<li>
								<a href="#"><img src="<?php echo SITE_URL; ?>img/demo/flags/cn.gif" alt=""><span> Chinese</span></a>
							</li>
						</ul>
					</li>
				</ul>
				<div class="dropdown">
					<?php $userId = $this->UserAuth->getUserId();?>
					<a href="#" class='dropdown-toggle' data-toggle="dropdown">
						<?php 
							if(!empty($userId)){
								echo h($var['User']['first_name']);
							};
						?> 
						<img src="<?php echo SITE_URL; ?>img/demo/user-avatar.jpg" alt="">
					</a>
					<ul class="dropdown-menu pull-right">
						<?php
						$contName = Inflector::camelize($this->params['controller']);
						$actName = $this->params['action'];
						$actionUrl = $contName.'/'.$actName;
						$activeClass='active';
						$inactiveClass='';
						if($this->UserAuth->HP('Users', 'myprofile')) {
							echo "<li class='".(($actionUrl=='Users/myprofile') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('View Profile'), array('controller'=>'Users', 'action'=>'myprofile', 'plugin'=>'usermgmt'))."</li>";
						}
						if($this->UserAuth->isLogged()) {
							if($this->UserAuth->HP('Users', 'editProfile')) {
								echo "<li class='".(($actionUrl=='Users/editProfile') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Edit Profile'), array('controller'=>'Users', 'action'=>'editProfile', 'plugin'=>'usermgmt'))."</li>";
							}
							if($this->UserAuth->HP('Users', 'changePassword')) {
								echo "<li class='".(($actionUrl=='Users/changePassword') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Change Password'), array('controller'=>'Users', 'action'=>'changePassword', 'plugin'=>'usermgmt'))."</li>";
							}
							echo "<li>".$this->Html->link(__('Sign Out'), '/logout')."</li>";
						} else {
							echo "<li class='".(($actionUrl=='Users/login') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Sign In'), '/login')."</li>";
						} ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid" id="content">
		<div id="left" class="force-full no-resize">
			<?php echo $this->element('staff.dashboard.left');?>
		</div>
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Pro Dashboard</h1>
					</div>
					<div class="pull-right">
						<ul class="stats">
							<li class='satgreen'>
								<i class="icon-money"></i>
								<div class="details">
									<span class="big">$657,129.00</span>
									<span>All Accounts</span>
								</div>
							</li>
							<li class='lightred'>
								<i class="icon-calendar"></i>
								<div class="details">
									<span class="big">February 22, 2013</span>
									<span>Wednesday, 13:56</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
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
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-reorder"></i>
									Administrative Dashboard
								</h3>
							</div>
							<div class="box-content">
								<?php
									echo $this->fetch('content');
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="footer">
		<p>
			&copy; Copyright 2012 - 2013 . IK Financial Markets Ltd. Technology by FXSolut.io .
		</p>
		<a href="#" class="gototop"><i class="icon-arrow-up"></i></a>
	</div>
		
	</body>
</html>