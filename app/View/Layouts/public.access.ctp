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

	#JS
		#jQuery
		echo $this->Html->script('jquery.min.js?q='.QRDN);
		#Nice Scroll
		echo $this->Html->script('plugins/nicescroll/jquery.nicescroll.min.js?q='.QRDN);
		#Validation
		echo $this->Html->script('plugins/validation/jquery.validate.min.js?q='.QRDN);
		echo $this->Html->script('plugins/validation/additional-methods.min.js?q='.QRDN);
		#iCheck
		echo $this->Html->script('plugins/icheck/jquery.icheck.min.js?q='.QRDN);
		#Bootstrap
		echo $this->Html->script('bootstrap.min.js?q='.QRDN);
		echo $this->Html->script('eakroko.js?q='.QRDN);
		#styling umstyle
     
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
		    ''.SITE_URL.'img/fxs-favicon.png',
		    ''.SITE_URL.'img/fxs-favicon.png',
		    array('type' => 'icon')
		);
	?>
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo SITE_URL;?>/img/fxs-2--144px.png" />

</head>

<body class='login theme-red'>
	<div class="wrapper">
		<div class="container-fluid" id="content">
			<h1><a href="#"><img src="<?php echo SITE_URL;?>/img/fxs-2--144px.png" alt="" class='retina-ready' width="59" height="49">IK Trust</a></h1>
			<div class="login-body">
				<?php echo $this->element('Usermgmt.message'); ?>
				<?php echo $this->element('Usermgmt.message_validation'); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
		<div id="footer" class="hidden-phone">
			<p>
				&copy; Copyright 2012 - 2013. IK Financial Markets Ltd .
			</p>
			<a href="#" class="gototop"><i class="icon-arrow-up"></i></a>
		</div>
	</div>
	
</body>

</html>