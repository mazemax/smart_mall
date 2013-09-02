// JavaScript Document
$(document).ready(function() {
	/*var mp_menu_open = readCookie('mp_menu_open');
	if(mp_menu_open == 1)
	{
		$('#button-menu-primary').addClass('selected');
		$('.menu-primary').css('display','block');
	}*/
	
	/*if($('.menu-primary').is(':visible'))
	{
		$('#button-menu-primary').addClass('selected');
	}
	else 
	{
		$('#button-menu-primary').removeClass('selected');
	}*/
	
	$('#button-menu-primary').click(function(event) {
		if(!$('.menu-primary').is(':visible'))
		{
			$(this).addClass('selected');
			//createCookie('mp_menu_open', 1, 365);
		}
		else {
			$(this).removeClass('selected');
			//createCookie('mp_menu_open', 0, 365);
		}
		
		$('.menu-primary').slideToggle();
		return false;
	});
});