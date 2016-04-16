<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package HospitalityWeb
 * @subpackage Travel_in_Italy
 * @since Travel in Italy 1.0.2
 */

get_header(); ?>

<h1 class="page-title author"><?php printf( __( 'Author Archives: %s', 'travelinitaly' ), "<a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" ); ?></h1>

<div id="container">
	<div id="content" role="main">

<?php
	get_template_part( 'loop', 'author' );
?>

	</div><!-- #content -->
</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
