<script type="text/javascript">
$(document).ready(function(){
	var formId      = '#<?php echo $formId; ?>';
	var button      = '#<?php echo $submitButtonId; ?>';
	var validate    = ajaxValidation();
	$(button).click(function(e){
		$(this).attr("disabled", "disabled");
		var self= this;
		var url = $(formId).attr('action');
		var element = $(formId);
		validate.doPost({
			url: url,
			buttonRef: self,
			element: element,
			callback: function(message) {
				$(self).removeAttr("disabled");
				if(message=='error') {
					$(self).unbind();
				} else {
					$(formId).submit();
				}
			}
		});
		return false;
	});

});
</script>