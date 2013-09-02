// JavaScript Document
$(document).ready(function() {
	var mp_breadcrumb_open = readCookie('mp_breadcrumb_open');
	if(mp_breadcrumb_open == 1)
	{
		$('.breadcrumb .breadcrumb-navigation').css('display','block');
	}
	
	$('.breadcrumb .icon-bead').click(function(event) {
		if(!$('.breadcrumb .breadcrumb-navigation').is(':visible'))
		{
			createCookie('mp_breadcrumb_open', 1, 365);
		}
		else 
		{
			createCookie('mp_breadcrumb_open', 0, 365);
		}
		
		$('.breadcrumb .breadcrumb-navigation').slideToggle();
		return false;
	});
});