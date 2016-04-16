<?php
/**
 * The template for displaying Archive pages.
 *
 * @package HospitalityWeb
 * @subpackage Travel_in_Italy
 * @since Travel in Italy 1.0.2
 */

get_header(); ?>

<h1 class="page-title">
<?php if ( is_day() ) : ?>
	<?php printf( __( 'Daily Archives: %s', 'travelinitaly' ), get_the_date() ); ?>
<?php elseif ( is_month() ) : ?>
	<?php printf( __( 'Monthly Archives: %s', 'travelinitaly' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'travelinitaly' ) ) ); ?>
<?php elseif ( is_year() ) : ?>
	<?php printf( __( 'Yearly Archives: %s', 'travelinitaly' ), get_the_date( _x( 'Y', 'yearly archives date format', 'travelinitaly' ) ) ); ?>
<?php else : ?>
	<?php _e( 'Blog Archives', 'travelinitaly' ); ?>
<?php endif; ?>
</h1>
        
<div id="container">
	<div id="content" role="main">

<?php
	if ( have_posts() )
		the_post();
		
	rewind_posts();
	get_template_part( 'loop', 'archive' );
?>

	</div><!-- #content -->
</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
