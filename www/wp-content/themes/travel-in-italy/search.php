<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package HospitalityWeb
 * @subpackage Travel_in_Italy
 * @since Travel in Italy 1.0.2
 */

get_header(); ?>

<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'travelinitaly' ), get_search_query() ); ?></h1>

<div id="container">
	<div id="content" role="main">

<?php 
if ( have_posts() ) {	
	get_template_part( 'loop', 'search' );
} else { ?>
	<div id="post-0" class="post hentry no-results not-found">
		<h2 class="entry-title"><?php _e( 'Nothing Found', 'travelinitaly' ); ?></h2>
		<div class="entry-content">
			<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'travelinitaly' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php } ?>

	</div><!-- #content -->
</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
