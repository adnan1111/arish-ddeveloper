<?php
/*
Plugin Name: Price Table Widget
Description: A powerful yet simple price table widget for your sidebars or Page Builder pages.
Version: 1.0.3
Author: Greg Priday
Author URI: http://siteorigin.com
Plugin URI: http://siteorigin.com/price-table-widget/
License: GPL3
License URI: license.txt
*/

define('SOW_PT_VERSION', '1.0.3');
define('SOW_PT_FILE', __FILE__);

function sow_pt_version_filter($versions){
	$versions[ plugin_basename(__FILE__) ] = include(plugin_dir_path(__FILE__).'base/version.php');
	return $versions;
}
add_action('siteorigin_widgets_include_version', 'sow_pt_version_filter');

function sow_pt_init(){
	if(defined('SITEORIGIN_WIDGETS_BASE_PARENT_FILE')) return;

	global $siteorigin_widget_include_versions;
	if( empty( $siteorigin_widget_include_versions ) ) {
		$siteorigin_widget_include_versions = apply_filters( 'siteorigin_widgets_include_version', array() );
		uasort($siteorigin_widget_include_versions, 'version_compare');
	}

	if( is_array($siteorigin_widget_include_versions) ) {
		$keys = array_keys($siteorigin_widget_include_versions);
		if( $keys[count($keys) - 1] == plugin_basename(__FILE__) ) {
			define('SITEORIGIN_WIDGETS_BASE_PARENT_FILE', __FILE__);
			define('SITEORIGIN_WIDGETS_BASE_VERSION', $siteorigin_widget_include_versions[plugin_basename(__FILE__)]);
			include plugin_dir_path(__FILE__).'base/inc.php';
		}
	}
}
add_action('plugins_loaded', 'sow_pt_init', 5);

/**
 * All the initialization stuff after the base SiteOrigin widget has been set up.
 */
function sow_pt_includes(){
	siteorigin_widget_register_self('price-table', __FILE__);
	include plugin_dir_path(__FILE__).'inc/widget.php';
}
add_action('plugins_loaded', 'sow_pt_includes');