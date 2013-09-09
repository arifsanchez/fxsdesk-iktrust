////file:app/webroot/js/application.js
	$(document).ready(function(){
	// Caching the email textbox:
	var email = $('#PartnerEmail');
	 
	// Defining a placeholder text:
	email.defaultText('Search Client Email');
	 
	// Using jQuery UI's autocomplete widget:
	email.autocomplete({
		minLength    : 1,
		source        : 'searchClient'
	});
	 
	});
	 
	// A custom jQuery method for placeholder text:
	 
	$.fn.defaultText = function(value){
	 
	var element = this.eq(0);
	element.data('defaultText',value);
	 
	element.focus(function(){
	if(element.val() == value){
	element.val('').removeClass('defaultText');
	}
	}).blur(function(){
	if(element.val() == '' || element.val() == value){
	element.addClass('defaultText').val(value);
	}
	});
	 
	return element.blur();
	}