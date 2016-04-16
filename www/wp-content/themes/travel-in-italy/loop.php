<?php
/**
 * The loop that displays posts.
 *
 * @package HospitalityWeb
 * @subpackage Travel_in_Italy
 * @since Travel in Italy 1.0.2
 */

if(!have_posts()) { 
?>
	<div id="post-0" class="post hentry error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'travelinitaly' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'travelinitaly' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php 
}

$num_posts = count($posts);
$i = 0; 
while(have_posts()) {
	the_post(); 
	$i++;
?>

    <div id="post-<?php the_ID(); ?>" <?php $i==$num_posts ? post_class() : post_class('hentry_border'); ?>>
        
<?php if(is_archive() || is_search() || is_front_page()) { ?>
        <div class="entry-summary">
        	<?php
			if(has_post_thumbnail()) {
				echo '<a href="'.get_permalink().'" title="'.esc_attr(get_the_title()).'">';
				the_post_thumbnail('thumbnail', array( 'class'=>'thumb', 'alt'=>esc_attr(get_the_title()) ));
				echo '</a>';
			}
			?>
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            <div style="margin-top:12px;"><?php 
				the_excerpt(); 
			?></div>
            <div style="clear:both;"></div>
        </div><!-- .entry-summary -->
<?php } else { ?>
        <div class="entry-content">
            <?php
			if(has_post_thumbnail()) {
				echo '<a href="'.get_permalink().'" title="'.esc_attr(get_the_title()).'">';
				the_post_thumbnail('thumbnail', array( 'class'=>'thumb', 'alt'=>esc_attr(get_the_title()) ));
				echo '</a>';
			}
			?>
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<div style="margin-top:12px;"><?php 
				the_content( __( '(read more)', 'travelinitaly' ) );
            	wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'travelinitaly' ), 'after' => '</div>' ) ); 
			?></div>
            <div style="clear:both;"></div>
        </div><!-- .entry-content -->
<?php } ?>

        <div class="entry-meta">
           <?php travelinitaly_posted_on(); ?> - <?php comments_popup_link( __( 'Leave a comment', 'travelinitaly' ), __( '1 Comment', 'travelinitaly' ), __( '% Comments', 'travelinitaly' ) ); ?>
        </div><!-- .entry-meta -->
        
    </div><!-- #post-## -->

    <?php comments_template( '', true ); ?>

<?php 
}

if($wp_query->max_num_pages > 1) { 	
	echo '<div class="pagination">';
	$big = 999999999; // need an unlikely integer
	echo paginate_links(array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages,
		'show_all' => false,
		'end_size' => 1,
		'mid_size' => 1,
		'prev_text' => "&laquo;",
		'next_text' => "&raquo;"
	));
	echo "</div>\n<div style='clear:both;'></div>\n";
} 
?>
