<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package HospitalityWeb
 * @subpackage Travel_in_Italy
 * @since Travel in Italy 1.0.2
 */

get_header(); ?>

<div id="container">
	<div id="content" role="main">

		<div id="post-0" class="post hentry error404 not-found">
			<h1 class="entry-title"><?php _e( 'Not Found', 'travelinitaly' ); ?></h1>
			<div class="entry-content">
				<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'travelinitaly' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		</div><!-- #post-0 -->

	</div><!-- #content -->
</div><!-- #container -->
<script type="text/javascript">
	// focus on search field after it has loaded
	document.getElementById('s') && document.getElementById('s').focus();
</script>

<?php get_footer(); ?>