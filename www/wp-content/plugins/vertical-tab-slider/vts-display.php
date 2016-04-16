<?php
//-- VTSLIDER SHOW Function ------------
//--------------------------------------
function vtslider_display() {

	// GET ALL OPTIONS VALUES ----------
	$options = get_option('vts_options');

	$sliderborder = $options['sliderborder'];
	$sliderbdrclr = $options['sliderbdrclr'];
	$imgwidth     = $options['imgwidth'];
	$imgheight    = $options['imgheight'];
	$sidebarwidth = $options['sidebarwidth'];

	$autoplay   =  $options['autoplay'];
	$navigation =  $options['navigation'];
	$effect     =  $options['effect'];    
	$pausehover =  $options['pausehover'];
	$timedelay	=  $options['timedelay']; 
	$transpeed	=  $options['transpeed'];
	
	$image1url	=  $options['image1url']; 
	$image1desp	=  $options['image1desp'];
	$image1link	=  $options['image1link'];
	$tab1title	=  $options['tab1title']; 
	$tab1desp	=  $options['tab1desp']; 
	
	$image2url	=  $options['image2url'];
	$image2desp	=  $options['image2desp'];
	$image2link	=  $options['image2link'];
	$tab2title	=  $options['tab2title']; 
	$tab2desp	=  $options['tab2desp'];
	
	$image3url	=  $options['image3url']; 
	$image3desp	=  $options['image3desp'];
	$image3link	=  $options['image3link'];
	$tab3title	=  $options['tab3title']; 
	$tab3desp	=  $options['tab3desp'];
	
	$image4url	=  $options['image4url']; 
	$image4desp	=  $options['image4desp'];
	$image4link	=  $options['image4link'];
	$tab4title	=  $options['tab4title'];
	$tab4desp	=  $options['tab4desp']; 
	
	$image5url	=  $options['image5url']; 
	$image5desp	=  $options['image5desp'];
	$image5link	=  $options['image5link'];
	$tab5title	=  $options['tab5title'];
	$tab5desp	=  $options['tab5desp']; 
				    
	$timedelay  = ($timedelay !="") ? $timedelay : '5000';
	$transpeed  = ($transpeed !="") ? $transpeed : '500';
	
	$navigation = ($navigation == 1) ? 'true' : 'false';
	$autoplay   = ($autoplay == 1) ? 'true' : 'false';
	$pausehover = ($pausehover == 1 ) ? 'true' : 'false';
	
	$sliderborder = ($sliderborder) ? $sliderborder : "0";
	$imgwidth     = ($imgwidth) ? $imgwidth : "500";
	$imgheight    = ($imgheight) ? $imgheight : "333";
	$sidebarwidth = ($sidebarwidth) ? $sidebarwidth : "200";
	$sliderTotalWidth = $imgwidth + $sidebarwidth;
	?>
	
	<!-- Vertical Tab Slider <?php if (function_exists('vts_plugin_version')) { echo vts_plugin_version(); } ?> Starts Here -->
	
	<script type="text/javascript">
		jQuery(document).ready(function(){
	
			jQuery('#vtslider').slidorion({
			    autoPlay   : <?php echo $autoplay; ?>,
				controlNav : <?php echo $navigation; ?>,
                effect     : '<?php echo $effect; ?>',
                interval   : <?php echo $timedelay; ?>,
                hoverPause : <?php echo $pausehover; ?>,
                speed      : <?php echo $transpeed; ?>
			});
			
			var HeadtotalHeight = 0,
			ConttotalHeight,
			SliderHeight = <?php echo $imgheight; ?>;
			
			jQuery("#vtslider .vts_accordion .vts_header").each(function(){
				HeadtotalHeight = HeadtotalHeight + jQuery(this).outerHeight();
			});
			
			ConttotalHeight = SliderHeight - HeadtotalHeight;
			jQuery("#vtslider .vts_accordion .vts_content").css({'max-height':ConttotalHeight});

		});
	</script>
	
	<style type="text/css">
		#vtslider { width:<?php echo $sliderTotalWidth.'px'; ?>;height: <?php echo $imgheight.'px'; ?>;border:<?php echo $sliderborder.'px'; ?> solid <?php echo $sliderbdrclr;  ?>}
		#vtslider .vts_slider,#vtslider .vts_slider .vts_slide img { width: <?php echo $imgwidth.'px'; ?>;height: <?php echo $imgheight.'px'; ?>}
		#vtslider .vts_accordion { width: <?php echo $sidebarwidth.'px'; ?>;height: <?php echo $imgheight.'px'; ?>}
	</style>
	
	<div id="vtslider" class="vtslider">
		<div class="vts_slider">
			<?php if($image1url && $tab1title){ ?><div class="vts_slide"><img src="<?php echo $image1url; ?>" /><?php if($image1desp) { ?><div class="vts_img_desp"><a <?php if($image1link) { echo 'href="'.$image1link.'"'; } ?>><?php echo stripslashes($image1desp); ?></a></div><?php } ?></div><?php } ?>
			<?php if($image2url && $tab2title){ ?><div class="vts_slide"><img src="<?php echo $image2url; ?>" /><?php if($image2desp) { ?><div class="vts_img_desp"><a <?php if($image2link) { echo 'href="'.$image2link.'"'; } ?>><?php echo stripslashes($image2desp); ?></a></div><?php } ?></div><?php } ?>
			<?php if($image3url && $tab3title){ ?><div class="vts_slide"><img src="<?php echo $image3url; ?>" /><?php if($image3desp) { ?><div class="vts_img_desp"><a <?php if($image3link) { echo 'href="'.$image3link.'"'; } ?>><?php echo stripslashes($image3desp); ?></a></div><?php } ?></div><?php } ?>
			<?php if($image4url && $tab4title){ ?><div class="vts_slide"><img src="<?php echo $image4url; ?>" /><?php if($image4desp) { ?><div class="vts_img_desp"><a <?php if($image4link) { echo 'href="'.$image4link.'"'; } ?>><?php echo stripslashes($image4desp); ?></a></div><?php } ?></div><?php } ?>
			<?php if($image5url && $tab5title){ ?><div class="vts_slide"><img src="<?php echo $image5url; ?>" /><?php if($image5desp) { ?><div class="vts_img_desp"><a <?php if($image5link) { echo 'href="'.$image5link.'"'; } ?>><?php echo stripslashes($image5desp); ?></a></div><?php } ?></div><?php } ?>
		</div>

		<div class="vts_accordion">
			<?php if($tab1title){ ?><div class="vts_header"><?php echo stripslashes($tab1title); ?></div><div class="vts_content"><?php if($tab1desp){ ?><div class="vts_cont-inner"><?php echo stripslashes($tab1desp); ?></div><?php } ?></div><?php } ?>
			<?php if($tab2title){ ?><div class="vts_header"><?php echo stripslashes($tab2title); ?></div><div class="vts_content"><?php if($tab2desp){ ?><div class="vts_cont-inner"><?php echo stripslashes($tab2desp); ?></div><?php } ?></div><?php } ?>
			<?php if($tab3title){ ?><div class="vts_header"><?php echo stripslashes($tab3title); ?></div><div class="vts_content"><?php if($tab3desp){ ?><div class="vts_cont-inner"><?php echo stripslashes($tab3desp); ?></div><?php } ?></div><?php } ?>
			<?php if($tab4title){ ?><div class="vts_header"><?php echo stripslashes($tab4title); ?></div><div class="vts_content"><?php if($tab4desp){ ?><div class="vts_cont-inner"><?php echo stripslashes($tab4desp); ?></div><?php } ?></div><?php } ?>
			<?php if($tab5title){ ?><div class="vts_header"><?php echo stripslashes($tab5title); ?></div><div class="vts_content"><?php if($tab5desp){ ?><div class="vts_cont-inner"><?php echo stripslashes($tab5desp); ?></div><?php } ?></div><?php } ?>
		</div>
		<div class="slidorion_clear"></div>
	</div>
	<!-- Vertical Tab Slider <?php if (function_exists('vts_plugin_version')) { echo vts_plugin_version(); } ?> Ends Here -->
	<?php
}

//-- ADD SHORTCODE [vtslider] ----------
//--------------------------------------
function vtslider_shortcode($atts) {
	ob_start();
    extract(shortcode_atts(array(
		"name" => ''
	), $atts));
	vtslider_display();
	$output = ob_get_clean();
	return $output;
}
add_shortcode('vtslider', 'vtslider_shortcode');
?>