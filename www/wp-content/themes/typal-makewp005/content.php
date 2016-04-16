<?php
/**
 * @package makewp005
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
<?php if ( get_post_format()!='' ) : ?>
<div class="metka genericon genericon-<?php echo get_post_format(); ?>"></div>
<?php endif;//get_post_format() ?>
<?php if ( has_post_format( array('aside', 'quote', 'link', 'chat', 'image', 'video', 'audio', 'gallery') ) ) : ?>
		<h1 class="entry-title" style="margin-top: -29px;"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
<?php else : ?>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
<?php endif;//h1 has_post_format() ?>

		<?php if ( 'post' == get_post_type() ) : ?>

		<div class="entry-meta">
		<?php makewp005_posted_on(); ?>

<?php if ( !has_post_format( array('aside', 'quote', 'link', 'chat', 'image', 'video', 'audio', 'gallery') ) ) : ?>

                              <!--begin more meta-->
                             <?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'makewp005' ) );
				if ( $categories_list && makewp005_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( '%1$s', 'makewp005' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'makewp005' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( '%1$s', 'makewp005' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>
                                <!--end more meta-->
<?php endif;//more meta has_post_format() ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
                <?php if ( has_post_thumbnail() ) : ?>
<div class="entry-thumbnail">
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('makewp005-medium'); ?></a>
	</div>
<div class="entry-excerpt">	
                <?php the_excerpt(); ?>
</div>
<div class="clear"></div>
	<?php else : //has_post_thumbnail() ?>
<?php if ( has_post_format(array('aside', 'quote', 'link', 'chat', 'image', 'video', 'audio')) ) : ?>
<?php the_content(); ?>
<?php else ://post_format() ?>
<?php the_excerpt(); ?>
<?php endif;//post_format() ?>
	<?php endif; //has_post_thumbnail() ?>
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
