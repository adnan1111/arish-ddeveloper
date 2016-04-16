<?php
/**
 * Template Name: One column, no sidebar
 *
 * @package HospitalityWeb
 * @subpackage Travel_in_Italy
 * @since Travel in Italy 1.0.2
 */

get_header(); ?>

<div id="container" class="one-column">
	<div id="content" role="main">

		<?php
		get_template_part( 'loop', 'page' );
		?>

	</div><!-- #content -->
</div><!-- #container -->

<?php get_footer(); ?>
