<?php
/**
 * The Template for displaying all single posts.
 *
 * @package makewp005
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php if ( has_post_format(array('aside', 'quote', 'link', 'status', 'gallery')) ) : ?>
			<?php get_template_part( 'content', get_post_format() );// 'single' ?>
			<?php else ://post_format() ?>
			<?php get_template_part( 'content', 'single' ); ?>
			<?php endif;//post_format() ?>

			<?php makewp005_content_nav( 'nav-below' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>