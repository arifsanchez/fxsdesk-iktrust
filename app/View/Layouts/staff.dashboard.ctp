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
		#Datepicker
		echo $this->Html->css('plugins/datepicker/datepicker.css?q='.QRDN);

		#choosen
		echo $this->Html->css('plugins/chosen/chosen.css?q='.QRDN);

		#Datatable
		echo $this->Html->css('plugins/datatable/TableTools.css?q='.QRDN);

	#JS
		#jQuery
		#echo $this->Html->script('jquery.min.js?q='.QRDN);
		/* Jquery latest version taken from http://jquery.com */
		echo $this->Html->script('/usermgmt/js/jquery-1.9.1');

		/* Jquery UI JS taken from http://jqueryui.com */
		echo $this->Html->script('/usermgmt/js/jquery-ui-1.10.2.custom.min');

		#jQuery UI
		#echo $this->Html->script('plugins/jquery-ui/jquery.ui.core.min.js?q='.QRDN);
		echo $this->Html->script('plugins/jquery-ui/jquery.ui.widget.min.js?q='.QRDN);
		echo $this->Html->script('plugins/jquery-ui/jquery.ui.mouse.min.js?q='.QRDN);
		echo $this->Html->script('plugins/jquery-ui/jquery.ui.resizable.min.js?q='.QRDN);
		echo $this->Html->script('plugins/jquery-ui/jquery.ui.sortable.min.js?q='.QRDN);
		echo $this->Html->script('plugins/jquery-ui/jquery.ui.spinner.js?q='.QRDN);

		#Bootstrap
		echo $this->Html->script('bootstrap.min.js?q='.QRDN);

		#Nice Scroll
		echo $this->Html->script('plugins/nicescroll/jquery.nicescroll.min.js?q='.QRDN);

		#Slim Scroll
		echo $this->Html->script('plugins/slimscroll/jquery.slimscroll.min.js?q='.QRDN);

		#Datepicker
		echo $this->Html->script('plugins/datepicker/bootstrap-datepicker.js?q='.QRDN);

		#Sparkline
		echo $this->Html->script('plugins/sparklines/jquery.sparklines.min.js?q='.QRDN);

		#Form
		echo $this->Html->script('plugins/form/jquery.form.min.js?q='.QRDN);

		#Notify
		echo $this->Html->script('plugins/gritter/jquery.gritter.min.js?q='.QRDN);

		#Bootbox
		echo $this->Html->script('plugins/bootbox/jquery.bootbox.js?q='.QRDN);

		#Theme Framework
		echo $this->Html->script('eakroko.min.js?q='.QRDN);

		#Theme Scripts
		echo $this->Html->script('application.min.js?q='.QRDN);

		/* Usermgmt Plugin JS */
		echo $this->Html->script('/usermgmt/js/umscript.js?q='.QRDN);

		/* Moment JS */
		echo $this->Html->script('moment.min');
		/* Livestamp JS */
		echo $this->Html->script('livestamp.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

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

	<?php echo $this->element('3rdparty.plugin.staff');?>
</head>

<body class="theme-blue" data-layout-sidebar="fixed" data-layout-topbar="fixed">
	<div id="navigation">
		<div class="container-fluid">
			<a href="<?php echo SITE_URL;?>" id="brand"><icon class="dashboard"></i> IK TRUST</a>
			<a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle Sidebar"><i class="icon-reorder"></i></a>

			<?php
				echo $this->element('staff.dashboard.navigate');
			;?>
			
			<div class="user">
				<div class="dropdown">
					<?php $userId = $this->UserAuth->getUserId();?>
					<a href="#" class='dropdown-toggle' data-toggle="dropdown">
						<?php 
							if(!empty($userId)){
								echo h($var['User']['first_name']);
							};
						?> 
						<img alt="<?php echo h($var['User']['first_name'].' '.$var['User']['last_name']); ?>" src="<?php echo $this->Image->resize('img/'.IMG_DIR, $var['UserDetail']['photo'], 27, null, true) ?>">
					</a>
					<ul class="dropdown-menu pull-right">
						<?php
						$contName = Inflector::camelize($this->params['controller']);
						$actName = $this->params['action'];
						$actionUrl = $contName.'/'.$actName;
						$activeClass='active';
						$inactiveClass='';
						if($this->UserAuth->HP('Users', 'myprofile')) {
							echo "<li class='".(($actionUrl=='Users/myprofile') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('View Profile'), array('controller'=>'Users', 'action'=>'myprofile?me:'.$var['User']['username'], 'plugin'=>'usermgmt'))."</li>";
						}
						if($this->UserAuth->isLogged()) {
							if($this->UserAuth->HP('Users', 'editProfile')) {
								echo "<li class='".(($actionUrl=='Users/editProfile') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Update Profile'), array('controller'=>'Users', 'action'=>'editProfile?me:'.$var['User']['username'], 'plugin'=>'usermgmt'))."</li>";
							}
							if($this->UserAuth->HP('Users', 'changePassword')) {
								echo "<li class='".(($actionUrl=='Users/changePassword') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Change Password'), array('controller'=>'Users', 'action'=>'changePassword?me:'.$var['User']['username'], 'plugin'=>'usermgmt'))."</li>";
							}
							echo "<li>".$this->Html->link(__('Sign Out'), '/logout?me:'.$var['User']['username'])."</li>";
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
				<?php echo $this->element('page.header.staff'); ?>
				<div class="row-fluid">
					<div class="span12">
						<?php
							echo $this->element('Usermgmt.message');
							echo $this->element('Usermgmt.message_validation');
							echo $this->fetch('content');
						?>
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