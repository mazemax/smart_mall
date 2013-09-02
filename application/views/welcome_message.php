<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Smart Mall Application</title>
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

<style type="text/css">
	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
</style>
</head>

<body>

<div id="container">
	<h1>Welcome to Smart Mall Application!</h1>

	<div id="body">
	<ul>
		<li><a href="<?php echo site_url('api/example/users');?>">Users</a> - defaulting to XML</li>
		<li><a href="<?php echo site_url('api/example/users/format/csv');?>">Users</a> - get it in CSV</li>
		<li><a href="<?php echo site_url('api/example/user/id/1');?>">User #1</a> - defaulting to XML</li>
		<li><a href="<?php echo site_url('api/example/user/id/1/format/json');?>">User #1</a> - get it in JSON</li>
		<li><a id="ajax" href="<?php echo site_url('api/example/users/format/json');?>">Users</a> - get it in JSON (AJAX request)</li>
	</ul>
	</div>	

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<script type="text/javascript">
$(function()
{
	// Bind a click event to the 'ajax' object id
	$("#ajax").bind("click", function( evt )
	{
		// Javascript needs to take over. So stop the browser from redirecting the page
		evt.preventDefault();
		// AJAX request to get the data
		$.ajax({
			// URL from the link that was clicked on
			url: $(this).attr("href"),
			// Success function. the 'data' parameter is an array of objects that can be looped over
			success: function(data, textStatus, jqXHR)
			{
				alert('Successful AJAX request!');
			}, 
			// Failed to load request. This could be caused by any number of problems like server issues, bad links, etc. 
			error: function(jqXHR, textStatus, errorThrown)
			{
				alert('Oh no! A problem with the AJAX request!');
			}
		});
	});
});
</script>

</body>
</html>
