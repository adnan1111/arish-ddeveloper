<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">

	<title><?php ui::title(); ?></title>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />

	<?php wp_head(); ?>
<script type="text/javascript">
		jQuery(function($){
			$("#menuhead ul").css({display:"none"}); // Opera Fix
			$("#menuhead li").hover(function(){
				$(this).find('ul:first').css({visibility:"visible",display:"none"}).show(268);
			}, function(){
				$(this).find('ul:first').css({visibility:"hidden"});
			});
		});
	</script>
		<style> <!-- added by arish --> 	/* Top Menu */ul#menuhead {width: 1020px;}ul#menuhead li {float: left;*padding: 0 22px 0 22px;list-style-type: none;width: auto !important;background-color:#FFBD13;               }ul#menuhead ul li {float:none;width: 150px;background-color:#FFD700;/* padding: 0 0px 0 0px; */margin: 0px;}#main-nav {	/*background-color: #fff;width: 1020px;*/	margin: 0 auto;       text-decoration:none;       background: blue;        padding: 0px;         margin: 0px 0px 0px; border-radius: 10px 10px 0px 0px; -webkit-border-radius: 10px 10px 0px 0px; -moz-border-radius: 10px 10px 0px 0px;	} #main-nav ul {	background-color: #ffbc13;	display: inline-block;	font-size: 12px;	font-weight: bold;	position: relative;	line-height: 1.8;	z-index: 300;	/*float:right;*/        margin: 0 auto;	text-decoration:none;        width: 960px; border-radius:5px 5px 0px 0px; -webkit-border-radius:5px 5px 0px 0px; -moz-border-radius:5px 5px 0px 0px;	} #main-nav ul li:first-child, #main-nav ul li:first-child a { border-radius:5px 0px 0px 0px; -webkit-border-radius:5px 0px 0px 0px; -moz-border-radius:5px 0px 0px 0px; } #main-nav ul ul {	display: none;	text-align:left;	position: absolute;	top: 38px;	margin-left:0px;	width: 130px;	text-decoration:none;	}#main-nav ul ul ul {	left: 140px;	top: auto;	text-decoration:none;}#main-nav ul li {	display: inline;	float: left;	line-height: 3;	position: relative;	text-decoration:none;}#main-nav > ul > li,#main-nav .menu > ul > li {	border-right: solid 1px #fff;}#main-nav ul li li {	line-height: 2.4;}#main-nav ul a {	color: #000000;	display: block;	padding: 0 22px 0 23px;	text-shadow: none;	text-decoration:none; font-size:13px;font-weight:normal; font-family:open-sans;}#main-nav ul a:hover,#main-nav .menu-item:hover,#main-nav .page_item:hover,#main-nav .current-menu-item > a,#main-nav .current-menu-ancestor > a,#main-nav .current_page_item > a,#main-nav .current_page_ancestor > a {	color: #ffffff !important;	background-color: #194880;}#main-nav ul ul a {	background-color: #194880;	border: 1px solid #0b3970;	border-bottom-color: #ffffff;	display: inline;	float: left;	text-shadow: none;	width: 153px; color:#ffffff;}#main-nav ul ul a:hover{background: #2460a8;}#main-nav li:hover ul ul,#main-nav li:hover ul ul ul,#main-nav li:hover ul ul ul ul {	display: none;}#main-nav li:hover ul,#main-nav li li:hover ul,#main-nav li li li:hover ul,#main-nav li li li li:hover ul {	display: block;}#footer {border-top: solid 0px #f99734; background-color: #ffd700;border-radius: 10px 10px 0px 0px; -webkit-border-radius: 5px 5px 0px 0px; -moz-border-radius: 5px 5px 0px 0px;width:960px;}span.contact-header{font-weight:bold; color:#ffffff; padding:6px 0px;font-size:16px;display:block;padding-left: 50px;padding-left: 104px;background-image: url('http://o2skills.com/wp-content/uploads/2014/09/contact-icon.png');background-repeat: no-repeat;background-position: 86px;}#search{float:right;padding-left:0px; padding-right:70px;} .jcarousel-pagination, .jw_easy_slider_name{display:none;}.jcarousel-control-prev, .jcarousel-control-next{top:76px !important;}.jcarousel-control-prev{right:0; left: -10px;} .jcarousel-wrapper{ box-shadow:none !important; } #social{ float:left; margin-top:0px; margin-left:0px; zoom: 1.5; } hr { border-top: 2px solid #e1e2e4 } #logo { margin-left:30px } #searchform input{background-image: url('http://o2skills.com/wp-content/uploads/2014/09/line2.jpg'); background-repeat: repeat-x; border: none;} input#searchsubmit {margin-left: -4px;background-image: url('http://o2skills.com/wp-content/uploads/2014/09/search-icon.png');background-repeat: no-repeat;background-color: transparent;color: transparent;background-position: center;} input#s {color: #5F6162;font-weight: 700;max-width: 194px; width:194px;}	#header #searchform {border: 2px solid #3F3F40; margin-left: 85px;background-image: url('http://o2skills.com/wp-content/uploads/2014/09/line2.jpg'); background-repeat: repeat-x;} .social{display: inline;width: 32px;float: left;margin-left: 45px;margin-top: 2px;} #main-nav > ul > li, #main-nav .menu > ul > li{ border-right: solid 1px #F6AB41; } #main-nav ul li:hover a { color:#ffffff !important; } .slideshow_container_style-light .slideshow_pagination, .slideshow_description{ display:none !important; } .slideshow_container .slideshow_content{ height:259px !important; border-radius:0px 0px 5px 5px; -webkit-border-radius: 0px 0px 5px 5px; -moz-border-radius: 0px 0px 5px 5px; } #content{ margin-bottom: -50px; }</style>

</head>

<body <?php body_class(); ?>>

	<div id="wrap">
		<div id="header">

			<div class="wrap">

				<div id="logo">
					<?php if (!option::get('misc_logo_path')) { echo "<h1>"; } ?>

					<a href="<?php echo home_url(); ?>" title="<?php bloginfo('description'); ?>">
						<?php if (!option::get('misc_logo_path')) { bloginfo('name'); } else { ?>
							<img src="<?php echo ui::logo(); ?>" alt="<?php bloginfo('name'); ?>" />
						<?php } ?>
					</a>

					<?php if (!option::get('misc_logo_path')) { echo "</h1>"; } ?>

					<?php if (option::get('logo_desc') == 'on') {  ?><p id="tagline"><?php bloginfo('description'); ?></p><?php } ?>
				</div>

				<div id="search">
					<!--<span class="contact-header">Contact Us: <a href="tel:9502833433" style="color:#ffffff;">9502833433</a></span>-->
					<div class="social">
						<a href="https://www.facebook.com/o2skills" target="_blank"><img class="fb-icon" src="http://o2skills.com/wp-content/uploads/2014/09/fb2.png" /></a>
					</div>
					<?php get_template_part('searchform'); ?>					<div class="placement-head"><h3><a href="http://o2skills.com/100-placement-guarantee-courses/">100% Placement Guarantee Courses</a></h3></div>
				</div>

				<?php get_template_part('wpzoom', 'social'); // calling social block ?>

				<div class="clear">&nbsp;</div>

			</div><!-- end .wrap -->

		</div><!-- end #header -->
<div id="main-nav">
			<!--<div class="wrap"> -->
				<?php wp_nav_menu( array( 'container' => '', 'container_class' => '', 'menu_class' => 'menu', 'menu_id' => 'menuhead', 'sort_column' => 'menu_order', 'theme_location' => 'primary' ) ); ?>
			<!-- </div> --><!-- end .wrap -->
		</div><!-- end #mainNav -->

		<!--<div id="crumbs">
			<div class="wrap">
				<p><?php wpzoom_breadcrumbs(); ?></p>
			</div><!-- end .wrap -->
		<!--</div> -->