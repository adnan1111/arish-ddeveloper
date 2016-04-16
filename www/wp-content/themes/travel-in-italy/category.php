<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package HospitalityWeb
 * @subpackage Travel_in_Italy
 * @since Travel in Italy 1.0.2
 */

get_header(); ?>

<h1 class="page-title"><?php single_cat_title('') ?></h1>
        
<div id="container">
	<div id="content" role="main">

		<?php
			$category_description = category_description();
			if ( ! empty( $category_description ) )
				echo '<div class="archive-meta">' . $category_description . '</div>';

			get_template_part( 'loop', 'category' );
		?>

	</div><!-- #content -->
</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
