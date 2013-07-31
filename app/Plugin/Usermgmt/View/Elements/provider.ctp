<?php
#File ini telah diubah !!!!!!

#css custom sendiri
?>


<?php if(USE_FB_LOGIN || USE_TWT_LOGIN || USE_GMAIL_LOGIN || USE_YAHOO_LOGIN || USE_LDN_LOGIN || USE_FS_LOGIN) { ?>
<div class="providerBox test3">
	<ul class="providers minitiles">
		<?php if(USE_FB_LOGIN){ ?>
		<li id="facebook" class="blue" title='<?php echo __('Facebook Connect');?>' onclick="javascript:login_popup('fb');return false;"><a href="#"><i class="icon-facebook"></i></a></li>
		<?php } if(USE_TWT_LOGIN){ ?>
		<li id="twitter" title='<?php echo __('Twitter Connect');?>' onclick="javascript:login_popup('twt');return false;"></li>
		<?php } if(USE_GMAIL_LOGIN){ ?>
		<li id="google" class="red" title='<?php echo __('Gmail Connect');?>' onclick="javascript:login_popup('gmail');return false;"><a href="#"><i class="icon-google-plus"></i></a></li>
		<?php } if(USE_YAHOO_LOGIN){ ?>
		<li id="yahoo" class="magenta" title='<?php echo __('Yahoo Connect');?>' onclick="javascript:login_popup('yahoo');return false;"><a href="#"><i class="glyphicon-yahoo"></i></a></li>
		<?php } if(USE_LDN_LOGIN){ ?>
		<li id="linkedin" title='<?php echo __('Linkedin Connect');?>' onclick="javascript:login_popup('ldn');return false;"></li>
		<?php } if(USE_FS_LOGIN){ ?>
		<li id="foursquare" title='<?php echo __('Foursquare Connect');?>' onclick="javascript:login_popup('fs');return false;"></li>
		<?php } ?>
		<div style="clear:both"></div>
	</ul>
</div>
<?php } ?>
<script language="JavaScript">
var newwindow;
function login_popup(url) {
	var  screenX    = typeof window.screenX != 'undefined' ? window.screenX : window.screenLeft,
	screenY    = typeof window.screenY != 'undefined' ? window.screenY : window.screenTop,
	outerWidth = typeof window.outerWidth != 'undefined' ? window.outerWidth : document.body.clientWidth,
	outerHeight = typeof window.outerHeight != 'undefined' ? window.outerHeight : (document.body.clientHeight - 22),
	width    = 500,
	height   = 500,
	left     = parseInt(screenX + ((outerWidth - width) / 2), 10),
	top      = parseInt(screenY + ((outerHeight - height) / 2.5), 10),
	features = (
		'width=' + width +
		',height=' + height +
		',left=' + left +
		',top=' + top+
		',scrollbars=yes'
	);
	newwindow=window.open('login/'+url,'',features);
	if (window.focus) {
		newwindow.focus()
	}
	return false;
}
</script>