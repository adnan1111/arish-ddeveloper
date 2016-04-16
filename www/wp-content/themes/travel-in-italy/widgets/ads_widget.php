<?php
/**
 * Plugin Name: Hospitality Web ADS Widget
 * Description: Displays an advertisement box containing an image
 * Version: 1.0
 * Author: Hospitality Web
 * Author URI: http://www.hospitalityweb.it/
 */

define('TRAVELINITALY_ADS_WIDTH', 300);

add_action( 'widgets_init', 'travelinitaly_ads_widget' );


function travelinitaly_ads_widget() {
	register_widget( 'TravelInItaly_ADS_Widget' );
}

class TravelInItaly_ADS_Widget extends WP_Widget {

	function TravelInItaly_ADS_Widget() {
		$widget_ops = array( 'classname' => 'travelinitaly', 'description' => __('Displays an advertisement box containing an image', 'travelinitaly') );
		$control_ops = array( 'width' => TRAVELINITALY_ADS_WIDTH, 'id_base' => 'travelinitaly-ads-widget' );
		$this->WP_Widget( 'travelinitaly-ads-widget', __('Hospitality Web ADS Widget', 'travelinitaly'), $widget_ops, $control_ops );
		add_action( 'sidebar_admin_setup', array( $this, 'admin_setup' ) );
		if(is_active_widget(false, false, $this->id_base)) {
			define('TRAVELINITALY_ADS_LOADED', true);
		}
	}
	
	function admin_setup() {
		wp_enqueue_media();
		wp_enqueue_script( 'travelinitaly-ads-widget', get_template_directory_uri().'/widgets/ads_widget.js', array( 'jquery', 'media-upload', 'media-views' ) );
		wp_localize_script( 'travelinitaly-ads-widget', 'ABSWidget_local', array(
			'frame_title' => __( 'Select image', 'travelinitaly' ),
			'button_title' => __( 'Insert into widget', 'travelinitaly' )
		));
	}
	
	/********************************************************************************************************
	 *	Stampa a video il contenuto del widget
	 ********************************************************************************************************/
	 
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$alt = $instance['alt'];
		$image_url = $instance['image_url'];
		$link = $instance['link'];
		$target = $instance['target'];
		
		echo $before_widget;
		
		// Titolo del widget
		if($title) echo $before_title . $title . $after_title;
		
		// Contenuto del widget
		if($image_url!='') {
			if($link!='') echo '<a href="'.$link.'" target="'.$target.'" title="'.esc_attr($alt).'">';
			echo '<img src="'.$image_url.'" width="'.TRAVELINITALY_ADS_WIDTH.'" alt="'.esc_attr($alt).'" />';
			if($link!='') echo '</a>';
		}
		
		echo $after_widget;
	}

	/********************************************************************************************************
	 *	Aggiornamento dei dati del widget
	 ********************************************************************************************************/ 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['alt'] = strip_tags( $new_instance['alt'] );
		$instance['link'] = strip_tags( $new_instance['link'] );
		$instance['target'] = $new_instance['target'];
		$instance['image_url'] = $new_instance['image_url'];
		return $instance;
	}

	/********************************************************************************************************
	 *	Form di configurazione del widget
	 ********************************************************************************************************/
	 	
	function form( $instance ) {
		$defaults = array( 
			'title' => __('Advertisement', 'travelinitaly'),
			'alt' => '',
			'link' => '',
			'target' => '_self',
			'image_url' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'travelinitaly'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label><?php _e('Image:', 'travelinitaly'); ?></label>
        </p>
		<div id="<?php echo $this->get_field_id( 'preview' ); ?>"><?php 
			if($instance['image_url']!='') echo '<img src="'.$instance['image_url'].'" width="'.TRAVELINITALY_ADS_WIDTH.'" />';
		?></div>
    	<p>
        	<input type="button" class="button" name="<?php echo $this->get_field_name( 'uploader_button' ); ?>" id="<?php echo $this->get_field_id( 'uploader_button' ); ?>" value="<?php _e('Select image', 'travelinitaly'); ?>" onclick="ABSWidget.uploader( '<?php echo $this->id; ?>', '<?php echo $this->get_field_id(''); ?>' );" />
			<input type="hidden" id="<?php echo $this->get_field_id('image_url'); ?>" name="<?php echo $this->get_field_name('image_url'); ?>" value="<?php echo $instance['image_url']; ?>" />
        </p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'alt' ); ?>"><?php _e('Alternate text:', 'travelinitaly'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'alt' ); ?>" name="<?php echo $this->get_field_name( 'alt' ); ?>" value="<?php echo $instance['alt']; ?>" />
		</p>
		
        <p>
			<label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e('Link:', 'travelinitaly'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo $instance['link']; ?>" />
            <select name="<?php echo $this->get_field_name( 'target' ); ?>" id="<?php echo $this->get_field_id( 'target' ); ?>">
				<option value="_self"<?php selected( $instance['target'], '_self' ); ?>><?php _e('Stay in window', 'travelinitaly'); ?></option>
				<option value="_blank"<?php selected( $instance['target'], '_blank' ); ?>><?php _e('Open new window', 'travelinitaly'); ?></option>
			</select>
		</p>
        
	<?php
	}
}

?>