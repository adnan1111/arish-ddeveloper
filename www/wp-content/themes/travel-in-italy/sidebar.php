<?php
/**
 * The Sidebar containing the primary widget area.
 *
 * @package HospitalityWeb
 * @subpackage Travel_in_Italy
 * @since Travel in Italy 1.0.2
 */

if(is_active_sidebar('primary-widget-area')) { 
?>

<div id="primary" class="widget-area" role="complementary">
	<ul class="xoxo">
		<?php dynamic_sidebar( 'primary-widget-area' ); ?>
	</ul>
</div><!-- #secondary .widget-area -->

<?php } ?>
