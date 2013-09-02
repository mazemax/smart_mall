<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">

<head>
<?php 
$controller_url = base_url("index.php/smart_mall/");
$content_url = base_url();
?>
<title>Welcome to Smart Mall</title>
	
<meta content="initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" name="viewport" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link rel="alternate" type="application/rss+xml" title="mobile Pro RSS Feed" href="<?php echo $content_url; ?>feed/index.html" />
<link rel="pingback" 		href="<?php echo $content_url; ?>xmlrpc.php" />
<link rel="shortcut icon" 	href="<?php echo $content_url; ?>favicon.ico" />
<link rel="stylesheet" 		href="<?php echo $content_url; ?>css/screen.css" type="text/css" media="screen, projection"/>
<link rel="stylesheet" 		href="<?php echo $content_url; ?>css/print.css" type="text/css" media="print"/>

 
<link rel="stylesheet" href="<?php echo $content_url; ?>style2.css"  type="text/css" />

<link rel="stylesheet" href="<?php echo $content_url; ?>css/monitor.css" type="text/css" media="only screen and (min-device-width: 481px)"/>
<link rel="stylesheet" href="<?php echo $content_url; ?>css/tablet.css" type="text/css" media="only screen and (min-device-width: 481px) and (orientation:portrait)"/>

<!--style switch-->
<!--<link rel="stylesheet alternate" href="<?php echo $content_url; ?>css/monitor.css" title="monitor" type="text/css" media="screen"/>-->
<link rel="stylesheet alternate" href="<?php echo $content_url; ?>css/tablet.css" title="tablet" type="text/css" media="screen"/>
<link rel="stylesheet alternate" href="<?php echo $content_url; ?>css/mobile.css" title="mobile" type="text/css" media="screen"/>

<link rel="stylesheet" href="<?php echo $content_url; ?>css/style_switch.css" type="text/css" media="screen"/>

<link rel="alternate" type="application/rss+xml" title="mobile Pro &raquo; Feed" href="<?php echo $content_url; ?>feed/index.html" />
<link rel="alternate" type="application/rss+xml" title="mobile Pro &raquo; Comments Feed" href="<?php echo $content_url; ?>comments/feed/index.html" />

<script type='text/javascript' src='<?php echo $content_url; ?>js/l10na17a.js?ver=20101110'></script>
<script type='text/javascript' src='<?php echo $content_url; ?>js/jquery/jquery-1.4.2.min583f.js?ver=3.1.3'></script>

<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo $content_url; ?>xmlrpc0db0.php?rsd" />

<link rel='index' title='mobile Pro' href='<?php echo $content_url; ?>index.html' />

<script type="text/javascript" src="<?php echo $content_url; ?>js/cookie.js"></script>
<script type="text/javascript" src="<?php echo $content_url; ?>js/initialize.menu.js"></script>
    <script type="text/javascript" src="<?php echo $content_url; ?>js/jquery/plugins/accordion/jquery.accordion.js"></script>
	<script type="text/javascript" src="<?php echo $content_url; ?>js/initialize.accordion.js"></script>    
<script type="text/javascript" src="<?php echo $content_url; ?>js/style.switch.js"></script>

</head>

<body class="home blog">
		
	<!--	Switch-Bar for Monitor, Tablet and Mobile Switching -->
	<div id="style-switch-bar" >
		<!--<a href="#" 																				rel="device" 	class="styleswitch" title="Autodetect">Auto</a>
		<a href="#?style=http://mobilepro.dmonzon.com/wp-content/themes/mobilepro/css/tablet.css" 	rel="tablet" 	class="styleswitch" title="Screen width > 480px, portrait orientation">Portrait tablet</a>		
		<a href="#?style=http://mobilepro.dmonzon.com/wp-content/themes/mobilepro/css/monitor.css" 	rel="monitor" 	class="styleswitch" title="Screen width > 480px">Landscape tablet and bigger</a>
		<a href="#?style=http://mobilepro.dmonzon.com/wp-content/themes/mobilepro/css/mobile.css" 	rel="mobile" 	class="styleswitch" title="Screen width < 480px">Mobile phone </a>-->
		<div class="logo">SMART MALL</div>
	</div>
	
	<div class="container">
		
	<div class="posts span-16 last">	
	
	<div class="post-93 post type-post status-publish format-standard sticky hentry category-user-interfaces" id="post-93">
            <h2 class="post-title">
                <span>
                    <span class="icon"></span>
                    A new approach to Shopping Mall          
				</span>
            </h2>
            <!-- end post-title -->
            
            <div class="post-info">
				
                <div class="post-excerpt">                	
                	<!--<h2>A new approach to shopping mall</h2>-->
					<p>Smart Mall is built on the idea that shopping malls can be more intuitive, efficient, and useful. And maybe even fun. After all, Smart Mall has:</p>
					<br/>
					
					<table>
						<tr><td>
							<img src="<?php echo $content_url; ?>images/Sale-256.png" width="50" height="50">
						</td>
						<td>
						<h2>Sales promotion</h2>					
						<p>Latest promos, discount, sales and offers from all the shops.</p>
						</td></tr>
						
						<tr><td>
							<img src="<?php echo $content_url; ?>images/entertainment_icon.png" width="50" height="50">
						</td>
						<td>
						<h2>Entertainment</h2>
						<p>Entertainment area including Cinema&#8217;s feeds and events.</p>
						</td></tr>
						
						<tr><td>
							<img src="<?php echo $content_url; ?>images/shopping_cart.png" width="50" height="50">
						</td>
						<td>
						<h2>Super store shopping</h2>
						<p>Easy, fast and interactive way of shopping the mall&#8217;s super store from anywhere.</p>
						</td></tr>
					</table>
					
                </div>               
            </div>
            <!-- end post-info -->
    </div>
        
	</div>
	<!-- main -->
        
        <!-- Header -->
        <div id="header" class="span-8">            
            
            <div class="bar">
                <ul class="h-list">
                    <li>                        
                        <?php echo validation_errors(); ?>
                        <form id="login-form" method="post" action="<?php echo $controller_url."/login"; ?>" >
							<h4>Sign in</h4>
							
							<h3>Username</h3> <input type="text" name="username" value="" />
							<h3>Password</h3> <input type="password" name="password" value="" />
														
							<input type="submit" name="login_submit" value="Sign In" />							
							
							<!--<div class="forgot_pass">
								<a href="<?php echo $controller_url; ?>/forgot_pass">
									Can't access your account?
								</a>
							</div>-->
						</form>
                    </li>                    
                </ul>
            </div>
            
            <div class="bar">
                <ul class="h-list">
                    <li>
                        <div id="new_account" style="text-align:center;">
							<h3>New to Smart Mall?</h3><br/>
							<a class="create_account" href="<?php echo $controller_url; ?>/new_user">Create Account</a>
                        </div>
                    </li>                    
                </ul>
            </div>
            
		</div>
		<!-- Header -->
			
    <!-- Footer -->
    <div class="footer">
		<div class="copyright">
				<a href="#" target="_blank">&copy; 2013 by Smart Mall</a>
		</div>		
	</div>
	<!-- Footer -->
    
    </div>
    <!-- container -->    
    
	</body>
	<!-- body -->
</html>
