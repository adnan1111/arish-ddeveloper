<?php
/**
 * The loop that displays a page.
 *
 * @package HospitalityWeb
 * @subpackage Travel_in_Italy
 * @since Travel in Italy 1.0.2
 */

if(have_posts()) while(have_posts()) {
	the_post(); 
?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php if ( is_front_page() ) { ?>
            <h2 class="entry-title"><?php the_title(); ?></h2>
        <?php } else { ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php } ?>
    
        <div class="entry-content"><?php 
			if(has_post_thumbnail()) {
				the_post_thumbnail('big_thumb', array( 'class'=>'thumb', 'alt'=>esc_attr(get_the_title()) ));
			}
			the_content();
            wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'travelinitaly' ), 'after' => '</div>' ) ); 
        ?></div><!-- .entry-content -->
    </div><!-- #post-## -->

<?php 
	comments_template( '', true );
} 
?>
