// JavaScript Document
(function($)
{
	$(document).ready(function() {
		$('.styleswitch').click(function()
		{
			switchStylestyle(this.getAttribute("rel"));
			$('.styleswitch.selected').removeClass('selected');
			$(this).addClass('selected');
			return false;
		});
		
		var c = readCookie('mp_style');
		
		if(c) {
			$('a[rel='+c+']').addClass('selected');
			switchStylestyle(c);
		}
		else $('a[rel=device]').addClass('selected');
	});

	function switchStylestyle(styleName)
	{
		$('link[@rel*=style][title]').each(function(i) 
		{
			this.disabled = true;
			if (this.getAttribute('title') == styleName) this.disabled = false;
		});
		
		if(styleName == 'device') {
			eraseCookie('mp_style');
		}
		else createCookie('mp_style', styleName, 365);
	}
})(jQuery);
