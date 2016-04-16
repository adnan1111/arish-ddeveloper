<?php
/**
 * The template for the home page.
 *
 * @package HospitalityWeb
 * @subpackage Travel_in_Italy
 * @since Travel in Italy 1.0.2
 */

function cutString($string, $max_char) {
	if(strlen($string)>$max_char) {
		$cutted_string = substr($string, 0, $max_char);
		$last_space = strrpos($cutted_string, " ");
		$string_ok = substr($cutted_string, 0, $last_space);
		return $string_ok."...";
	} else {
		return $string;
	}
}
	
// READ THE LIST OF SHOWCASE POSTS
$showcase_posts = array();
$showcase_query = new WP_Query(array(
	'post_type' => 'post',
	'orderby' => 'rand', 
	'posts_per_page' => -1,
	'meta_key' => '_in_showcase',
    'meta_value' => '1',
    'meta_compare' => '='
));
if($showcase_query->have_posts()) {
	while($showcase_query->have_posts()) {
		$showcase_query->the_post();
		if(get_post_meta(get_the_ID(),'_in_showcase',true)==1) {
			$showcase_posts[] = array(
				'id' => get_the_ID(),
				'title' => get_the_title(),
				'has_image' => has_post_thumbnail()
			);
		}
	}
}
wp_reset_postdata();

// READ THE LIST OF POPULAR POSTS
$popular_posts = array();
$popular_query = new WP_Query(array(
	'post_type' => 'post',
	'orderby' => 'rand', 
	'posts_per_page' => -1,
	'meta_key' => '_in_popular',
    'meta_value' => '1',
    'meta_compare' => '='
));
if($popular_query->have_posts()) {
	while($popular_query->have_posts()) {
		$popular_query->the_post();
		if(get_post_meta(get_the_ID(),'_in_popular',true)==1) {
			$popular_posts[] = array(
				'id' => get_the_ID(),
				'title' => get_the_title(),
				'excerpt' => get_the_excerpt(),
				'has_image' => has_post_thumbnail()
			);
		}
	}
}
wp_reset_postdata();

get_header(); ?>

<?php
// SHOWCASE POSTS
if(count($showcase_posts)) {
	echo '<div id="container_showcase">
		<div id="box_showcase">';
	foreach($showcase_posts as $k=>$s) {
		echo '<div class="box_showcase_p" '.($k!=0 ? 'style="display:none;"' : '').'>';
        if($s['has_image']) {
			echo '<a href="'.get_permalink($s['id']).'" title="'.esc_attr($s['title']).'">'.get_the_post_thumbnail($s['id'], 'showcase_thumb', array( 'alt'=>esc_attr($s['title']) )).'</a>';
        }
		echo '<a href="'.get_permalink($s['id']).'" title="'.esc_attr($s['title']).'" class="box_showcase_t">'.$s['title'].'</a>';
        echo '</div>';
	}
	echo '</div>';
	if($k>0) {
		echo '<img id="box_showcase_prev" src="'.get_bloginfo('template_directory').'/images/freccia-slide-sx.jpg" width="39" height="41" alt="&lt;" style="z-index:'.($k+3).';" />';
		echo '<img id="box_showcase_next" src="'.get_bloginfo('template_directory').'/images/freccia-slide-dx.jpg" width="39" height="41" alt="&gt;" style="z-index:'.($k+3).';" />';
	}
	echo '</div>';
	if($k>0) {
	?>
	<script type="text/javascript">//<![CDATA[
	jQuery(function() {
		jQuery("#box_showcase").cycle({ 
			fx:"fade", speed:1000, timeout:2000, pause:1,
			next:"#box_showcase_next", prev:"#box_showcase_prev"		
		});
	});
	//]]></script> 
    <?php
	}
}
?>

<?php
// POPULAR POSTS
if(count($popular_posts)) {
	echo '<h2 class="title-popular">'.__("Popular posts",'travelinitaly').'</h2>';
	echo '<div id="box_popular">';
    $popular_page = 0;
	foreach($popular_posts as $k=>$s) {
    	if($k%3==0) echo '<div class="box_popular_p" '.($popular_page!=0 ? 'style="display:none;"' : '').'>';
        echo '<div class="box_popular_post" '.($k%3==2 ? 'style="margin-right:0;"' : '').'>
			<a href="'.get_permalink($s['id']).'" title="'.esc_attr($s['title']).'">';
        if($s['has_image']) {
			echo get_the_post_thumbnail($s['id'], 'popular_thumb', array( 'alt'=>esc_attr($s['title']) ));
        } else {
            echo '<img src="'.get_bloginfo('template_directory').'/images/segnaposto.jpg" alt="" border="0" width="300" height="190" />';
        }
        echo '</a>
			<a href="'.get_permalink($s['id']).'" title="'.esc_attr($s['title']).'" class="zoom">&nbsp;</a>
			<a class="box_popular_title" href="'.get_permalink($s['id']).'" title="'.esc_attr($s['title']).'">'.$s['title'].'</a>
			<p class="box_popular_excerpt">'.cutString($s['excerpt'],130).'</p>';
        echo '</div>';
        if($k%3==2) {
			echo '<div style="clear:both"></div></div>';
			$popular_page++;
		}
    }
    if($k%3!=2) {
		echo '<div style="clear:both"></div></div>';
		$popular_page++;
	}
    echo '</div>';
	if($popular_page>1) {
	?>
	<script type="text/javascript">//<![CDATA[
	jQuery(function() {
		jQuery("#box_popular").cycle({ 
			fx:"scrollLeft", speed:1000, timeout:3000, pause:1	
		});
	});
	//]]></script> 
    <?php
	}
}
?>

<h2 class="title-latest"><?php _e("Latest posts",'travelinitaly') ?></h2>
<div id="container">
	<div id="content" role="main">
	<?php
	get_template_part( 'loop', 'index' );
	?>
	</div><!-- #content -->
</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>