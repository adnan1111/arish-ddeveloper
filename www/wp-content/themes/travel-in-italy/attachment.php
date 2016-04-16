<?php
/**
 * The template for displaying attachments.
 *
 * @package HospitalityWeb
 * @subpackage Travel_in_Italy
 * @since Travel in Italy 1.0.2
 */

get_header(); ?>

<div id="container" class="single-attachment">
	<div id="content" role="main">

	<?php
	get_template_part( 'loop', 'attachment' );
	?>

	</div><!-- #content -->
</div><!-- #container -->

<?php get_footer(); ?>
