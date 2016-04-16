<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package HospitalityWeb
 * @subpackage Travel_in_Italy
 * @since Travel in Italy 1.0.2
 */

get_header(); ?>

<h1 class="page-title"><?php
	printf( __( 'Tag Archives: %s', 'travelinitaly' ), single_tag_title( '', false ) );
?></h1>
        
<div id="container">
	<div id="content" role="main">

		<?php
 		get_template_part( 'loop', 'tag' );
		?>
	
    </div><!-- #content -->
</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
