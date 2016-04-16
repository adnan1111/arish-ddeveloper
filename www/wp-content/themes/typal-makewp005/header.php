<?php
/**
 * The Header for our theme.
 * @package makewp005
 */
$options = get_option('makewp005_theme_settings');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" />
<title>
<?php wp_title( '|', true, 'right' ); ?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
<?php if(empty($options['upload_mainlogo'])) { ?>
<?php $header_text_color = get_header_textcolor(); ?>
<div id="logo">
<?php if ( !is_home() ) : ?>
<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" style="color:<?php echo '#'.$header_text_color; ?>"><?php bloginfo( 'name' ); ?></a></h1>
<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
<?php else : ?>
<h1 class="site-title" style="color:<?php echo '#'.$header_text_color; ?>"><?php bloginfo( 'name' ); ?></h1>
<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
<?php endif; //!is_front_page() ?>
</div><!--logo-->
<?php } else { //if(empty) ?>

<div id="logo">
<?php if ( !is_front_page() ) : ?>
<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo $options['upload_mainlogo']; ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'description' ); ?>" style="margin-top:0px;margin-left:0px;border:0;"></a>
<?php else : ?>
<img src="<?php echo $options['upload_mainlogo']; ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'description' ); ?>" style="margin-top:0px;margin-left:0px;border:0;">
<?php endif; //!is_front_page() ?>
</div><!--logo-->
<?php } //if(empty)?>


<?php if( !empty($options['home_tel']) ) : ?>
<div id="headphone">
<?php echo $options['home_tel']; ?>
</div>
<?php endif; //!empty home_tel ?>
<div style="clear: both;"></div>

		</div><!--site-branding-->

<div id="menubar">	
<nav id="site-navigation" class="nav-menu" role="navigation">

<h1 class="menu-toggle"><?php _e( 'Menu', 'makewp005' ); ?></h1>			
<!-- navigation -->
<?php 
if(has_nav_menu('primary')){
wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'div', 'container_id' => 'menu-main', 'menu_class' => 'sf-menu', 'depth' => 3 ) ); 
}else {
?>
<div id="menu-main">
<ul class="sf-menu">
<?php wp_list_pages('title_li='); ?>
</ul>
</div>
<?php
}
?>

</nav><!-- #site-navigation -->
</div><!--menubar-->

	</header><!-- #masthead -->

	<div id="content" class="site-content">
