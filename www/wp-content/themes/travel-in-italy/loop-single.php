<?php
/**
 * The loop that displays a single post.
 *
 * @package HospitalityWeb
 * @subpackage Travel_in_Italy
 * @since Travel in Italy 1.0.2
 */

if(have_posts()) while(have_posts()) {
	the_post(); 
?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1 class="entry-title"><?php the_title(); ?></h1>

        <div class="entry-meta">
            <?php travelinitaly_posted_on(); ?>
        </div><!-- .entry-meta -->

        <div class="entry-content"><?php 
			if(has_post_thumbnail()) {
				the_post_thumbnail('post_thumb', array( 'class'=>'thumb', 'alt'=>esc_attr(get_the_title()) ));
			}
			the_content();
            wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'travelinitaly' ), 'after' => '</div>' ) ); 
		?></div><!-- .entry-content -->

    </div><!-- #post-## -->

    <div id="nav-below" class="navigation">
        <div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&laquo;', 'Previous post link', 'travelinitaly' ) . '</span> %title', true ); ?></div>
        <div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&raquo;', 'Next post link', 'travelinitaly' ) . '</span>', true ); ?></div>
    </div><!-- #nav-below -->

<?php 
	comments_template( '', true );
}
?>
