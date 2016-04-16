<?php
/**
 * The template for Quote post format
 * @package makewp005
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
<?php if ( get_post_format()!='' ) : ?>
<div class="metka genericon genericon-<?php echo get_post_format(); ?>"></div>
<?php endif;//get_post_format() ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content" style="margin-top: -20px;">
<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'makewp005' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>
	<footer class="entry-meta" style="text-align: right;">
			<?php if( get_post_format()!='' ) : ?>
<span class="genericon genericon-<?php echo get_post_format(); ?>" style="margin: 0 3px 0 5px;"></span><a href="<?php echo esc_url( get_post_format_link( get_post_format() ) ); ?>"><?php echo get_post_format_string( get_post_format() ); ?></a>
<?php endif;//get_post_format() ?>
                                <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'makewp005' ), __( '1 Comment', 'makewp005' ), __( 'Comments: %', 'makewp005' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'makewp005' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
