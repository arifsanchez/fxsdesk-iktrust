<!--
# Untuk kegunaan traders dashboard . Base layout .
-->
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>IK Trust | FXSdesk</title>

	<?php
	#CSS
		#Bootstrap
		echo $this->Html->css('bootstrap.min.css?q='.QRDN);
		#Bootstrap responsive
		echo $this->Html->css('bootstrap-responsive.min.css?q='.QRDN);
		#iCheck
		echo $this->Html->css('plugins/icheck/all.css?q='.QRDN);
		#Theme
		echo $this->Html->css('style.css?q='.QRDN);
		#Color CSS
		echo $this->Html->css('themes.css?q='.QRDN);
		#jQuery UI 
		echo $this->Html->css('plugins/jquery-ui/smoothness/jquery-ui.css?q='.QRDN);
		echo $this->Html->css('plugins/jquery-ui/smoothness/jquery.ui.theme.css?q='.QRDN);

	#JS
		#jQuery
		echo $this->Html->script('jquery.min.js?q='.QRDN);
		#Mobile nav swipe
	    echo $this->Html->script('plugins/touchwipe/touchwipe.min.js?q='.QRDN);
		#Nice Scroll
		echo $this->Html->script('plugins/nicescroll/jquery.nicescroll.min.js?q='.QRDN);
		#jQuery UI
		echo $this->Html->script('plugins/jquery-ui/jquery.ui.core.min.js?q='.QRDN);
		echo $this->Html->script('plugins/jquery-ui/jquery.ui.widget.min.js?q='.QRDN);
		echo $this->Html->script('plugins/jquery-ui/jquery.ui.mouse.min.js?q='.QRDN);
		echo $this->Html->script('plugins/jquery-ui/jquery.ui.resizable.min.js?q='.QRDN);
		echo $this->Html->script('plugins/jquery-ui/jquery.ui.sortable.min.js?q='.QRDN);
		#slimScroll
		echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js?q='.QRDN);
		#Validation
		echo $this->Html->script('plugins/validation/jquery.validate.min.js?q='.QRDN);
		echo $this->Html->script('plugins/validation/additional-methods.min.js?q='.QRDN);
		#iCheck
		echo $this->Html->script('plugins/icheck/jquery.icheck.min.js?q='.QRDN);
		#Bootstrap
		echo $this->Html->script('bootstrap.min.js?q='.QRDN);
		echo $this->Html->script('eakroko.js?q='.QRDN);
		#Bootbox
		echo $this->Html->script('plugins/bootbox/jquery.bootbox.js?q='.QRDN);
		echo $this->Html->script('plugins/form/jquery.form.min.js?q='.QRDN);
		#Theme scripts
		echo $this->Html->script('application.min.js?q='.QRDN);
		#Just for demonstration
		echo $this->Html->script('demonstration.min.js?q='.QRDN);
		#imagesLoaded
		echo $this->Html->script('plugins/imagesLoaded/jquery.imagesloaded.min.js?q='.QRDN);
	?>

	<!--[if lte IE 9]>
		<?php echo $this->Html->script('/plugins/placeholder/jquery.placeholder.min?q='.QRDN); ?>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
	
	<?php
		#FAVicon
		echo $this->Html->meta(
		    'fxicon.png',
		    '/fxicon.png',
		    array('type' => 'icon')
		);
	?>
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="../img/apple-touch-icon-precomposed.png" />

</head>

<body data-layout="fixed" class="theme-lightred" data-theme="theme-lightred" data-mobile-sidebar="slide">
	<div id="navigation">
		<div class="container-fluid">
			<a href="#" id="brand">FLAT</a>
			<a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
			<ul class='main-nav'>
				<?php echo $this->element('navigasi'); ?>
			</ul>
			<div class="user">
				<ul class="icon-nav">
			
				</ul>
				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown">Welcome, John Doe</a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="more-userprofile.html">Edit profile</a>
						</li>
						<li>
							<a href="#">Account settings</a>
						</li>
						<li>
							<a href="more-login.html">Sign out</a>
						</li>
					</ul>
				</div>
			</div><!-- TAMAT USER CLASS -->
		</div>
	</div>
	<div class="container" id="content">
		<div id="left">
			<form action="search-results.html" method="GET" class='search-form'>
				<div class="search-pane">
					<input type="text" name="search" placeholder="Search here...">
					<button type="submit"><i class="icon-search"></i></button>
				</div>
			</form>
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Content</span></a>
				</div>
				<ul class="subnav-menu">
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">Articles</a>
						<ul class="dropdown-menu">
							<li>
								<a href="#">Action #1</a>
							</li>
							<li>
								<a href="#">Antoher Link</a>
							</li>
							<li class='dropdown-submenu'>
								<a href="#" data-toggle="dropdown" class='dropdown-toggle'>Go to level 3</a>
								<ul class="dropdown-menu">
									<li>
										<a href="#">This is level 3</a>
									</li>
									<li>
										<a href="#">Unlimited levels</a>
									</li>
									<li>
										<a href="#">Easy to use</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<li>
						<a href="#">News</a>
					</li>
					<li>
						<a href="#">Pages</a>
					</li>
					<li>
						<a href="#">Comments</a>
					</li>
				</ul>
			</div>
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Plugins</span></a>
				</div>
				<ul class="subnav-menu">
					<li>
						<a href="#">Cache manager</a>
					</li>
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">Import manager</a>
						<ul class="dropdown-menu">
							<li>
								<a href="#">Action #1</a>
							</li>
							<li>
								<a href="#">Antoher Link</a>
							</li>
							<li class='dropdown-submenu'>
								<a href="#" data-toggle="dropdown" class='dropdown-toggle'>Go to level 3</a>
								<ul class="dropdown-menu">
									<li>
										<a href="#">This is level 3</a>
									</li>
									<li>
										<a href="#">Unlimited levels</a>
									</li>
									<li>
										<a href="#">Easy to use</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<li>
						<a href="#">Contact form generator</a>
					</li>
					<li>
						<a href="#">SEO optimization</a>
					</li>
				</ul>
			</div>
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-down"></i><span>Settings</span></a>
				</div>
				<ul class="subnav-menu">
					<li>
						<a href="#">Theme settings</a>
					</li>
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">Page settings</a>
						<ul class="dropdown-menu">
							<li>
								<a href="#">Action #1</a>
							</li>
							<li>
								<a href="#">Antoher Link</a>
							</li>
							<li class='dropdown-submenu'>
								<a href="#" data-toggle="dropdown" class='dropdown-toggle'>Go to level 3</a>
								<ul class="dropdown-menu">
									<li>
										<a href="#">This is level 3</a>
									</li>
									<li>
										<a href="#">Unlimited levels</a>
									</li>
									<li>
										<a href="#">Easy to use</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<li>
						<a href="#">Security settings</a>
					</li>
				</ul>
			</div>
			<div class="subnav subnav-hidden">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'><i class="icon-angle-right"></i><span>Default hidden</span></a>
				</div>
				<ul class="subnav-menu">
					<li>
						<a href="#">Menu</a>
					</li>
					<li class='dropdown'>
						<a href="#" data-toggle="dropdown">With submenu</a>
						<ul class="dropdown-menu">
							<li>
								<a href="#">Action #1</a>
							</li>
							<li>
								<a href="#">Antoher Link</a>
							</li>
							<li class='dropdown-submenu'>
								<a href="#" data-toggle="dropdown" class='dropdown-toggle'>More stuff</a>
								<ul class="dropdown-menu">
									<li>
										<a href="#">This is level 3</a>
									</li>
									<li>
										<a href="#">Easy to use</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<li>
						<a href="#">Security settings</a>
					</li>
				</ul>
			</div>
		</div>
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Fixed layout</h1>
					</div>
					<div class="pull-right">
						<ul class="minitiles">
							<li class='grey'>
								<a href="#"><i class="icon-cogs"></i></a>
							</li>
							<li class='lightgrey'>
								<a href="#"><i class="icon-globe"></i></a>
							</li>
						</ul>
						<ul class="stats">
							<li class='satgreen'>
								<i class="icon-money"></i>
								<div class="details">
									<span class="big">$324,12</span>
									<span>Balance</span>
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
							<a href="layouts-sidebar-hidden.html">Layouts</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="layouts-fixed.html">Fixed layout</a>
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
									Basic Widget
								</h3>
							</div>
							<div class="box-content">
								Content
							</div>
						</div>
					</div>
				</div>
			</div>
		</div></div>
		
	</body>


</html>