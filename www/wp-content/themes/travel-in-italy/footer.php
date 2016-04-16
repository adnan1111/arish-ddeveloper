<?php
/**
 * The template for displaying the footer.
 *
 * @package HospitalityWeb
 * @subpackage Travel_in_Italy
 * @since Travel in Italy 1.0.2
 */
?>
	</div><!-- #main -->

	<div id="footer" role="contentinfo">
    
    	<?php if(is_active_sidebar('footer-widget-area')) {
		echo '<div id="footer-widgets"><ul class="xoxo">';
		dynamic_sidebar( 'footer-widget-area' );
		echo '</ul><div style="clear:both"></div></div>';
    	} ?> 
    
		<div id="colophon">
        	<?php printf(
				__( '%1$s is powered by %2$s - Theme designed by %3$s', 'travelinitaly' ),
				'<a href="' . home_url() . '">' . get_bloginfo( 'name' ) . '</a>',
				'<a href="http://wordpress.org">' . __( 'WordPress', 'travelinitaly' ) . '</a>',
				'<a href="http://www.hospitalityweb.it" target="_blank" title="Hospitality Web">' . __( 'Hospitality Web', 'travelinitaly' ) . '</a>'	
			); ?>
		</div><!-- #colophon -->
	</div><!-- #footer -->

</div><!-- #wrapper -->

<?php
	wp_footer();
?>
</body>
</html>
