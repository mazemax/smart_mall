<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">

<head>
<?php 
$controller_url = base_url("index.php/smart_mall/");
$content_url  	= base_url();
?>
<title>Smart Mall - Home</title>
	
<meta content="initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" name="viewport" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link rel="alternate" type="application/rss+xml" title="mobile Pro RSS Feed" href="<?php echo $content_url; ?>feed/index.html" />
<link rel="pingback" 		href="<?php echo $content_url; ?>xmlrpc.php" />
<link rel="shortcut icon" 	href="<?php echo $content_url; ?>favicon.ico" />
<link rel="stylesheet" 		href="<?php echo $content_url; ?>css/screen.css" type="text/css" media="screen, projection"/>
<link rel="stylesheet" 		href="<?php echo $content_url; ?>css/print.css" type="text/css" media="print"/>

 
<link rel="stylesheet" href="<?php echo $content_url; ?>style.css"  type="text/css" />

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

<script>
var url="<?php echo $controller_url;?>";
function do_delete(id)
{
    var r=confirm("Do you want to delete this?")
	if (r==true)
	  window.location = url+"/movie_delete/"+id;
	else
	  return false;
}
</script>
</head>

<body class="home blog">
		
	<!--	Switch-Bar for Monitor, Tablet and Mobile Switching -->
	<div id="style-switch-bar" >
		<!--<a href="#" 																				rel="device" 	class="styleswitch" title="Autodetect">Auto</a>
		<a href="#?style=http://mobilepro.dmonzon.com/wp-content/themes/mobilepro/css/tablet.css" 	rel="tablet" 	class="styleswitch" title="Screen width > 480px, portrait orientation">Portrait tablet</a>
		<a href="#?style=http://mobilepro.dmonzon.com/wp-content/themes/mobilepro/css/monitor.css" 	rel="monitor" 	class="styleswitch" title="Screen width > 480px">Landscape tablet and bigger</a>
		<a href="#?style=http://mobilepro.dmonzon.com/wp-content/themes/mobilepro/css/mobile.css" 	rel="mobile" 	class="styleswitch" title="Screen width < 480px">Mobile phone</a>-->
		<div class="logo">SMART MALL</div>
		<div class="logo_right">
			<span>Welcome <?php echo $username; ?></span>
			<a href="<?php echo $controller_url.'/logout'; ?>">Sign Out</a>
		</div>
	</div>
	
	<div class="container">
        
        <!-- Header -->
        <div id="header" class="span-8">			
            <div style="background-image:url(<?php echo $content_url; ?>images/headers/1_grey.png)" class="banner">                
                <div class="social">
                    <ul class="h-list">
                    	<li><a href="#" target="_blank"><img src="<?php echo $content_url; ?>images/twitterIcon.png"  alt="Twitter"  /></a></li>
						<!--<li><a href="#" target="_blank">	<img src="<?php echo $content_url; ?>images/dribbbleIcon.png"  alt="dribbble"  /></a></li>-->
						<li><a href="#" target="_blank">								
							<img src="<?php echo $content_url; ?>images/facebookIcon.png"  alt="facebook"  />
							</a>
						</li>
                    </ul>
                </div>
            <a id="logo" href="<?php echo $controller_url; ?>/main_page" title="Smart Mall" style="background-image:url(<?php echo $content_url; ?>images/logo.png)">Smart Mall</a>
            </div>
            
            <div class="bar">
                <ul class="h-list">
                    <li class="first">
                        <a id="button-menu-primary" class="link-button gray-link-button" >
							<span class="icon-fold icon"></span>Menu
						</a>
                    </li>
                    <!--<li class="last">
                        <form id="search-form" method="get" action="" >
							<input type="text" name="s" id="s" value="" />
							<button name="search" title="Search">Search</button>
						</form>                    
					</li>-->
                </ul>
            </div>
            
            <div class="menu-primary">
				<ul id="menu-main" class="v-list">
					<li id="menu-item-16" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-16">
						<a href="<?php echo $controller_url; ?>/main_page">Home</a>
					</li>
					<li id="menu-item-236" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-236">
						<a href="<?php echo $controller_url; ?>/movie_add">Add Movie</a>
					</li>
					<li id="menu-item-236" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-236">
						<a href="<?php echo $controller_url; ?>/notifications_add">Add Notification</a>
					</li>
					<li id="menu-item-236" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-236">
						<a href="<?php echo $controller_url; ?>/notifications_display">View Notification</a>
					</li>
					<li id="menu-item-13" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-13">
						<a href="<?php echo $controller_url; ?>/update_user">Account Settings</a>
						<!--<ul class="sub-menu">
							<li id="menu-item-9" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-9">
								<a href="sub_menu.html">Sub-Menu</a>
							</li>
						</ul>-->
					</li>					
					<!--<li id="menu-item-50" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-50">
						<a href="<?php echo $controller_url; ?>/contact_us">Contact Us</a>
					</li>-->
				</ul>
			</div>        
		</div>
		<!-- Header -->
			
<div class="posts span-16 last" id="main">
	
	<!-- breadcrumb -->
	<div class="breadcrumb">
		<div class="breadcrumb-toolbar">
			<a class="icon-home icon" href="<?php echo $controller_url; ?>/main_page" title="Home">Home</a>
        </div>
        
    <div class="breadcrumb-navigation">
        <div>
            <!-- Breadcrumb NavXT 3.9.0 -->
			<span>Home</span>
		</div>
	</div>
	
	</div>
	<!-- breadcrumb -->
	
	<div class="post-93 post type-post status-publish format-standard sticky hentry category-user-interfaces" id="post-93">
            <h2 class="post-title">
                <span>
                    <span class="icon"></span>
                    Home           </span>
            </h2>
            <!-- end post-title -->
            
            <div class="post-info">
				<div class="post-meta">
					<!--<a class="post-thumbnail" href="2011/06/30/93/index.html">
						<img width="68" height="68" src="wp-content/uploads/2011/06/tabletProSetV3Preview-68x68.jpg" class="attachment-thumbnail" alt="tabletProSetV3Preview" title="tabletProSetV3Preview" />
					</a>
                    <a href="2011/06/30/93/index.html#comments" class="post-comments-count"  title="Comment on Tablet/Phone UI PRO V 3.0">3</a>
                    <strong>By: </strong>admin<br />
                    <strong>Date: </strong>June 30, 2011<br/>
                    <strong class="entry-utility-prep entry-utility-prep-tag-links">Tagged: </strong> <a href="tag/dark/index.html" rel="tag">dark</a>, <a href="tag/interface/index.html" rel="tag">interface</a>, <a href="tag/mobile/index.html" rel="tag">mobile</a>, <a href="tag/pro/index.html" rel="tag">pro</a>, <a href="tag/psd/index.html" rel="tag">PSD</a>, <a href="tag/switch/index.html" rel="tag">switch</a>, <a href="tag/texture/index.html" rel="tag">texture</a>, <a href="tag/user/index.html" rel="tag">user</a>, <a href="tag/wheel/index.html" rel="tag">wheel</a>
                    -->
                </div>                
                <div>
					<?php
						  if(strlen($message) > 0)
						  {
							echo '<div class="success">'.$message.'</div>';
						  }
					?>
					<p class="blocktext">
						<table style="table-layout:fixed; width:115%;">
						<tr>
							<td>
								<b>Title</b>
							</td>
							<!--<td style="word-wrap: break-word">
								<b>Year</b>
							</td>-->
							<td style='width:10px;'></td>
							<td></td>
						</tr>
						
						<?php
						if(!empty($movies))
						{
							foreach($movies as $m)
							{
								echo "<tr>";
								echo "<td>".$m['Movie_Name']."</td>";
								echo "<td><a href='".$controller_url."/movie_update/".$m['Movie_ID']."'><img src='".$content_url."images/Edit.png'></a></td>";
								echo "<td><a href='javascript:void(0);' onClick='do_delete(".$m['Movie_ID'].");'><img src='".$content_url."images/Delete.png'></a></td>";
								echo "</tr>";
							}
						}
						?>
						
						</table>
						
						<?php //var_dump($r_menus); ?>
					</p>
					<!--<p class="blocktext">
						<br/><a class="blue-link-button" href="<?php echo $controller_url; ?>/register_devices">Add/Change Device</a><br/>
						<br/><a class="blue-link-button" href="<?php echo $controller_url; ?>/track_devices">Track my Device</a><br/>
						<br/><a class="blue-link-button" href="<?php echo $controller_url; ?>/update_user">Account Settings</a><br/>
						<br/>
					</p>
					<br/><a class="link-button black-link-button" href="2011/06/30/93/index.html">Add/Change Device</a><br/>
					<br/><a class="link-button black-link-button" href="2011/06/30/93/index.html">Track my Device</a><br/>
					<br/><a class="link-button black-link-button" href="2011/06/30/93/index.html">Account Settings</a><br/>
                <br/><a class="link-button black-link-button" href="2011/06/30/93/index.html">Read more</a>-->
                </div>
            </div>
            <!-- end post-info -->
    </div>
    
    <!--<div class="h-separator"></div>-->
	
	<!-- Navigation -->
	<!--<div class='wp-pagenavi'>	
		<span class='current'>1</span>
			<a href='page/2/index.html' class='page larger'>2</a>
			<a href="page/2/index.html" class="nextpostslink">></a>
	</div>-->
	<!-- Navigation -->
</div>
<!-- main -->

<!-- ========== SIDE-BAR ========== -->
<div class="span-8" id="sidebar">
	<!--<div id="pages-2" class="widget widget_pages">
	<h2>Pages</h2>		
		<ul>
			<li class="page_item page-item-48"><a href="contacts/index.html" title="Contacts">Contacts</a></li>
			<li class="page_item page-item-208"><a href="features/index.html" title="Features">Features</a></li>
			<li class="page_item page-item-2"><a href="sample-page/index.html" title="Sample Page">Sample Page</a></li>
		</ul>
	</div>-->
	
	<!--	CALENDAR
	==================================================
	<div id="calendar-3" class="widget widget_calendar">
	<h2>Calendar</h2>
	<div id="calendar_wrap">
	<table id="wp-calendar" summary="Calendar">
	<caption>December 2011</caption>
	<thead>
	<tr>
		<th scope="col" title="Monday">M</th>
		<th scope="col" title="Tuesday">T</th>
		<th scope="col" title="Wednesday">W</th>
		<th scope="col" title="Thursday">T</th>
		<th scope="col" title="Friday">F</th>
		<th scope="col" title="Saturday">S</th>
		<th scope="col" title="Sunday">S</th>
	</tr>
	</thead>

	<tfoot>
	<tr>
		<td colspan="3" id="prev"><a href="2011/06/index.html" title="View posts for June 2011">&laquo; Jun</a></td>
		<td class="pad">&nbsp;</td>
		<td colspan="3" id="next" class="pad">&nbsp;</td>
	</tr>
	</tfoot>

	<tbody>
	<tr>
		<td colspan="3" class="pad">&nbsp;</td><td>1</td><td>2</td><td>3</td><td>4</td>
	</tr>
	<tr>
		<td>5</td><td id="today">6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td>
	</tr>
	<tr>
		<td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td>
	</tr>
	<tr>
		<td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td><td>25</td>
	</tr>
	<tr>
		<td>26</td><td>27</td><td>28</td><td>29</td><td>30</td><td>31</td>
		<td class="pad" colspan="1">&nbsp;</td>
	</tr>
	</tbody>
	</table>
	</div>
	</div>-->
	
	<!--<div id="rss-3" class="widget widget_rss">
		<h2><a class='rsswidget' href='http://dmonzon.com/feed/' title='Syndicate this content'>
			<img style='border:0' width='14' height='14' src='wp-includes/images/rss.png' alt='RSS' /></a> 
			<a class='rsswidget' href='http://dmonzon.com/' title='mobile application design.'>dmonzon news</a>
		</h2>
		<ul>
			<li><a class='rsswidget' href='http://dmonzon.com/2011/12/03/steel-buttons-freebie/' title='I made this freebie for fun, trying to capture the beauty of the steel on my phone. Feel free to download the .psd file and play with it. [&hellip;]'>Steel Buttons Freebie</a></li><li><a class='rsswidget' href='http://dmonzon.com/2011/11/09/siri-freebie/' title='I felt in love with the Siri alarm clock and tried to reproduce it . If you love it like me, feel free to download the .psd file and play with it. Your comments are very appreciated. Please Tweet it to Share it and Download [&hellip;]'>Siri Freebie</a></li><li><a class='rsswidget' href='http://dmonzon.com/2011/10/29/system-preferences-free-psd-icon/' title='This OSX System Preferences icon is completely free and made with Adobe Photoshop shapes. So you can resize it without loosing shape quality . Download, Share and Enjoy [&hellip;]'>System Preferences Free PSD Icon</a></li><li><a class='rsswidget' href='http://dmonzon.com/2011/10/26/944/' title='You get a set of 230 completely editable and infinitely scalable icons, specially made for mobile application designers and developers, but useful for any designer. You get the icons in five different formats, including PNG, AI, EPS, PSD and CSH (Photoshops custom shape format). [&hellip;]'>Mobile Pro Vector Icons</a></li>
		</ul>
		</div>
	</div>-->
		
<div class="posts span-24 last" id="footer"></div>

</div>
<!-- ========== SIDE-BAR ========== -->
    
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
