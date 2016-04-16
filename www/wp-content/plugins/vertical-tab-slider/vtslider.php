<?php
/*
Plugin Name: Vertical Tab Slider
Plugin URI: http://wptreasure.com/downloads/vertical-tab-slider/
Description: A very attractive and cool looking tabbing slider which gives a user to rotate their images and description in slides with great effect.
Author: wptreasure
Version: 1.0.0
Author URI: http://wptreasure.com/
*/
// -----------------------------------------------------------------

// INCLUDE REQUIRED FILES ------------------------------------------
//------------------------------------------------------------------
include_once('vts-settings.php');
include_once('vts-display.php');

// ADD STYLE AND SCRIPT INSIDE HEAD SECTION ------------------------
//------------------------------------------------------------------
add_action('admin_init', 'vts_backend_scripts');
add_action('wp_enqueue_scripts', 'vts_frontend_scripts');

function vts_backend_scripts() {
	if(is_admin()){
		if(isset($_REQUEST['page']) && $_REQUEST['page']=="vtslider") {
			wp_enqueue_script('jquery');
			wp_enqueue_style('vts_backend_scripts',plugins_url('css/vtslider_admin.css',__FILE__), false, '1.0.0' );
			wp_enqueue_script('vts_backend_scripts',plugins_url('js/vtslider_admin.js',__FILE__), array('jquery'));
			wp_enqueue_script('wp-color-picker');
			wp_enqueue_style('wp-color-picker' );
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
			wp_enqueue_style('thickbox');
		}
	}
}

function vts_frontend_scripts() {	
	if(!is_admin()) {
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-easing',plugins_url('js/jquery.easing.js',__FILE__), array('jquery'));
		wp_enqueue_script('jquery-slidorion',plugins_url('js/jquery.slidorion.js',__FILE__), array('jquery'));
		wp_enqueue_style('vtslider',plugins_url('css/vtslider.css',__FILE__));
	}
}

// CALL 'ADMIN_MENU' HOOK FOR ADDING MENU IN ADMIN SECTION ---------
//------------------------------------------------------------------
add_action('admin_menu', 'vts_plugin_admin_menu');
function vts_plugin_admin_menu() {
    add_menu_page('Vertical Tab Slider Page', 'V-Tab Slider','administrator', 'vtslider', 'vts_backend_menu',plugins_url('images/icon.png',__FILE__));
}


// ADD DEFAULT VALUES FOR THE SLIDER -------------------------------
//------------------------------------------------------------------
function vts_defaults(){
	    $default = array(
		'sliderborder'=> '10',
		'sliderbdrclr'=> '#BBBBBB',
		'imgwidth'    => '500',
		'imgheight'   => '333',
		'sidebarwidth'=> '200',
		'autoplay'   => 1,
		'navigation' => 1,
		'effect'     => 'fade',
		'pausehover' => 1,
		'timedelay'  => '5000',
		'transpeed'  => '500',
		'image1url'  =>  plugins_url('images/1.jpg',__FILE__),
		'image1desp' => 'Image 1 Description',
		'image1link' => 'http://wptreasure.com/',
		'tab1title'  => 'Tab 1',
		'tab1desp'   => 'Tab 1 Description',
		'image2url'  =>  plugins_url('images/2.jpg',__FILE__),
		'image2desp' => 'Image 2 Description',
		'image2link' => 'http://wptreasure.com/',
		'tab2title'  => 'Tab 2',
		'tab2desp'   => 'Tab 2 Description',
		'image3url'  =>  plugins_url('images/3.jpg',__FILE__),
		'image3desp' => 'Image 3 Description',
		'image3link' => 'http://wptreasure.com/',
		'tab3title'  => 'Tab 3',
		'tab3desp'   => 'Tab 3 Description',
		'image4url'  =>  plugins_url('images/4.jpg',__FILE__),
		'image4desp' => 'Image 4 Description',
		'image4link' => 'http://wptreasure.com/',
		'tab4title'  => 'Tab 4',
		'tab4desp'   => 'Tab 4 Description',
		'image5url'  =>  plugins_url('images/5.jpg',__FILE__),
		'image5desp' => 'Image 5 Description',
		'image5link' => 'http://wptreasure.com/',
		'tab5title'  => 'Tab 5',
		'tab5desp'   => 'Tab 5 Description'
    );
return $default;
}

// RUNS WHEN PLUGIN IS ACTIVATED AND ADD OPTION IN wp_option TABLE -
//------------------------------------------------------------------
register_activation_hook(__FILE__,'vts_plugin_install');
function vts_plugin_install() {
    add_option('vts_options', vts_defaults());
}	
function vts_plugin_version(){
	if (!function_exists( 'get_plugins' ) )
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$plugin_file = basename( ( __FILE__ ) );
	return $plugin_folder[$plugin_file]['Version'];
}
