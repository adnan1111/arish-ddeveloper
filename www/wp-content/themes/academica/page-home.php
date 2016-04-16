<?php

/*
Template Name: Home page
*/

global $wpz_template;

if ( !isset($wpz_template) || empty($wpz_template) ) $wpz_template = '';



get_header();

?>

<script type="text/javascript" src="http://o2skills.com/wp-content/themes/academica/js/jquery.simplyscroll.js"></script>

<link rel="stylesheet" href="http://o2skills.com/wp-content/themes/academica/css/jquery.simplyscroll.css" />

<script>
jQuery(function($){

	$("#scroller").simplyScroll({frameRate:60});

});
</script>

<?php do_action('slideshow_deploy', '689'); ?>

<div id="content">



	<div class="wrap">



		<!--<div class="sep sepinside">&nbsp;</div>-->



		<?php

		wp_reset_query();



		if ( have_posts() ) :



			while ( have_posts() ) :



				the_post();



				if ( $wpz_template == '' || $wpz_template == 'side-left' ) { ?><div class="column column-narrow">&nbsp;</div><!-- end .column-narrow --><?php }



				?><div class="column <?php echo $wpz_template == 'full-width' || $wpz_template == 'side-right' ? 'column-full' : 'column-double'; ?> column-content column-last">



					<h1><?php the_title(); ?></h1>



				</div><!-- end .column-double -->



				<div class="clear">&nbsp;</div>



				<?php

				if ( $wpz_template == '' || $wpz_template == 'side-left' ) {



					?><div class="column column-narrow">



						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar: Pages (Left)') ) echo '&nbsp;'; ?>



					</div><!-- end .column-narrow --><?php



				}

				?>



				<div class="column<?php if ( $wpz_template == 'side-left' || $wpz_template == 'side-right' ) echo ' column-double'; elseif ( $wpz_template == 'full-width' ) echo ' column-full'; ?> column-content<?php if ( $wpz_template == 'side-left' || $wpz_template == 'full-width' ) echo ' column-last'; ?> single">



					<?php

					the_content('');

					

					wp_link_pages( array( 'before' => '<p class="pages"><strong>' . __('Pages', 'wpzoom') . ':</strong> ', 'after' => '</p>', 'next_or_number' => 'number' ) );

					?>
					
					<div class="simply-scroll simply-scroll-container">
						<div class="simply-scroll-clip">
							<ul id="scroller" class="simply-scroll-list" style="width: 6480px;">
								<li><a href="#"><img alt="Client Image" class="img-responsive" src="http://o2skills.com/wp-content/uploads/easy_logo_slider/210792logos_0016_Layer-16.png"></a></li>
								<li><a href="#"><img alt="Client Image" class="img-responsive" src="http://o2skills.com/wp-content/uploads/easy_logo_slider/946895logos_0017_Layer-15.png"></a></li>
								<li><a href="#"><img alt="Client Image" class="img-responsive" src="http://o2skills.com/wp-content/uploads/easy_logo_slider/163333logos_0018_Layer-14.png"></a></li>
								<li><a href="#"><img alt="Client Image" class="img-responsive" src="http://o2skills.com/wp-content/uploads/easy_logo_slider/833472logos_0019_Layer-13.png"></a></li>
								<li><a href="#"><img alt="Client Image" class="img-responsive" src="http://o2skills.com/wp-content/uploads/easy_logo_slider/323336logos_0020_Layer-12.png"></a></li>
								<li><a href="#"><img alt="Client Image" class="img-responsive" src="http://o2skills.com/wp-content/uploads/easy_logo_slider/497054logos_0021_Layer-11.png"></a></li>
								<li><a href="#"><img alt="Client Image" class="img-responsive" src="http://o2skills.com/wp-content/uploads/easy_logo_slider/596728logos_0022_Layer-10.png"></a></li>
								<li><a href="#"><img alt="Client Image" class="img-responsive" src="http://o2skills.com/wp-content/uploads/easy_logo_slider/837942logos_0023_Layer-9.png"></a></li>
								<li><a href="#"><img alt="Client Image" class="img-responsive" src="http://o2skills.com/wp-content/uploads/easy_logo_slider/448949logos_0024_Layer-8.png"></a></li>
								<li><a href="#"><img alt="Client Image" class="img-responsive" src="http://o2skills.com/wp-content/uploads/easy_logo_slider/905265logos_0025_Layer-7.png"></a></li>
								<li><a href="#"><img alt="Client Image" class="img-responsive" src="http://o2skills.com/wp-content/uploads/easy_logo_slider/788519logos_0027_Layer-5.png"></a></li>
								<li><a href="#"><img alt="Client Image" class="img-responsive" src="http://o2skills.com/wp-content/uploads/easy_logo_slider/203745logos_0028_Layer-4.png"></a></li>
								<li><a href="#"><img alt="Client Image" class="img-responsive" src="http://o2skills.com/wp-content/uploads/easy_logo_slider/122915logos_0030_Layer-3.png"></a></li>
								<li><a href="#"><img alt="Client Image" class="img-responsive" src="http://o2skills.com/wp-content/uploads/easy_logo_slider/750384logos_0031_Layer-2.png"></a></li>
								<li><a href="#"><img alt="Client Image" class="img-responsive" src="http://o2skills.com/wp-content/uploads/easy_logo_slider/685129logos_0032_Layer-1.png"></a></li>
								
							</ul>
						</div>
					</div>



					<p class="postmetadata"><?php edit_post_link( __('EDIT', 'wpzoom'), ' / ', ''); ?></p>



					<?php comments_template(); ?>



				</div><!-- end .column-content -->



				<?php

				if ( $wpz_template == '' || $wpz_template == 'side-right' ) {



					?><div class="column column-narrow column-last">



						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar: Pages (Right)') ) echo '&nbsp;'; ?>



					</div><!-- end .column-narrow --><?php



				}



			endwhile;



		endif;

		?>



		<div class="clear">&nbsp;</div>



	</div><!-- end .wrap -->



</div><!-- end #content -->



<?php get_footer(); ?>