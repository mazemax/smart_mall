<!DOCTYPE html>
<html lang="en">
<head>
	<?php $controller_url = base_url("index.php/ws_client/"); ?>
	<meta charset="utf-8">
	<title>Testing Page - New User Registration</title>
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
	<h1>Testing Page - New User Registration</h1>

	<div id="body">
		<?php //echo validation_errors(); ?>
		<?php echo form_open($controller_url."/reg_user"); ?>
			
			<?php echo form_error('username'); ?>
			Email:
			<?php
			$data1 = array(
				  'name'        => 'username',
				  'id'          => 'username',
				  'value'       => '',
				  'maxlength'   => '50',
				  'size'        => '25',
				  //'style'       => 'width:50%',
				);
			echo form_input($data1);
			?><br/>
			
			<?php echo form_error('password'); ?>
			Password:
			<?php
			$data2 = array(
				  'name'        => 'password',
				  'id'          => 'password',
				  'value'       => '',
				  'maxlength'   => '50',
				  'size'        => '25',
				  //'style'       => 'width:50%',
				);
			echo form_password($data2);
			?><br/>
			
			<?php echo form_error('again_password'); ?>
			Reenter Password:
			<?php
			$data3 = array(
				  'name'        => 'again_password',
				  'id'          => 'again_password',
				  'value'       => '',
				  'maxlength'   => '50',
				  'size'        => '25',
				  //'style'       => 'width:50%',
				);
			echo form_password($data3);
			?><br/>
			
			<?php echo form_error('User_Status'); ?>
			User Status:
			<?php
			$options = array(
				  'ACTIVE'      => 'ACTIVE',
				  'INACTIVE'    => 'INACTIVE',
				);
			echo form_dropdown('User_Status', $options, 'ACTIVE');
			?><br/>
			
			<?php echo form_error('User_Type'); ?>
			User Type:
			<?php
			$options = array(
							  1  => 'System Admin',
							  2  => 'Clients - Shops',
							  3  => 'Clients - Resturant',
							  4  => 'Store Keeper',
							  5  => 'Cinema',
							  6  => 'Customer',
							);
			$other_data = 'id="User_Type"';
			echo form_dropdown('User_Type', $options,1,$other_data);
			?><br/>
			<?php echo form_submit('new_user_submit', 'Create my Account'); ?>
		<?php echo form_close(); ?>		
	</div>	

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>
