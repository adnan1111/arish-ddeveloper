<?php
/**
 * @package makewp005
 */

add_action( 'admin_init', 'makewp005_theme_settings_init' );
add_action( 'admin_menu', 'makewp005_add_settings_page' );

/*=SETUP----------------------------------------------------*/
/*------------------------------------------------------------------*/

function makewp005_theme_settings_init(){
	register_setting( 'makewp005_theme_settings', 'makewp005_theme_settings', 'makewp005_options_validate' );
}

// add js for admin
function options_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
}

//add css for admin
function options_style() {
	wp_enqueue_style('thickbox');
}
function options_echo_scripts()
{
?>

<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function() {

// Media Uploader
window.formfield = '';

jQuery('.upload_image_button').live('click', function() {
	window.formfield = jQuery('.upload_field',jQuery(this).parent());
	tb_show('', 'media-upload.php?type=image&TB_iframe=true');
	return false;
});

window.original_send_to_editor = window.send_to_editor;
window.send_to_editor = function(html) {
	if (window.formfield) {
		imgurl = jQuery('img',html).attr('src');
		window.formfield.val(imgurl);
		tb_remove();
	}
	else {
		window.original_send_to_editor(html);
	}
	window.formfield = '';
	window.imagefield = false;
}

});
//]]> 
</script>
<?php
}

if (isset($_GET['page']) && $_GET['page'] == 'sett') {
	add_action('admin_print_scripts', 'options_scripts'); 
	add_action('admin_print_styles', 'options_style');
	add_action('admin_head', 'options_echo_scripts');
}


function makewp005_add_settings_page() {
add_theme_page( __( 'Theme Settings', 'makewp005' ), __( 'Theme Settings', 'makewp005' ), 'manage_options', 'sett', 'makewp005_theme_settings_page');
}

function makewp005_theme_settings_page() {	
?>

<!--GO Options-->

<div class="wrap">

<?php
if ( isset ($_GET['settings-updated']) ) { ?>
<div id="message" class="updated fade -message"><p><?php _e('Options Saved','makewp005'); ?></p></div>
<?php } ?>

<div id="icon-options-general" class="icon32"></div>
<h2><?php _e( ' Typal theme Settings', 'makewp005' ) ?></h2>

<form method="post" action="options.php">

<?php settings_fields( 'makewp005_theme_settings' ); ?>
<?php $options = get_option( 'makewp005_theme_settings' ); ?>

<table class="form-table">  

<tr valign="top">
<th scope="row"><?php _e( 'Logo', 'makewp005' ); ?></th>
<td>
<input id="makewp005_theme_settings[upload_mainlogo]" class="regular-text upload_field" type="text" size="36" name="makewp005_theme_settings[upload_mainlogo]" value="<?php echo esc_url($options['upload_mainlogo']); ?>" />
<input class="upload_image_button button-secondary" type="button" value="Upload Image" />
<br />
<label class="description abouttxtdescription" for="makewp005_theme_settings[logo]"><?php _e( 'Upload or enter URL file the logo image. Recommended image size 150x60px','makewp005'); ?></label>
</td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Tel', 'makewp005' ); ?></th>
<td>
<input id="makewp005_theme_settings[home_tel]" class="regular-text" type="text" size="36" name="makewp005_theme_settings[home_tel]" placeholder="Call us<br />8 800 00-00-00" value="<?php echo esc_textarea($options['home_tel']); ?>" />
<br />
<label class="description abouttxtdescription" for="makewp005_theme_settings[home_tel]"><?php _e( 'Enter the primary contact number or slogan of the header.','makewp005'); ?></label>
</td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Heading Box', 'makewp005' ); ?></th>
<td>
<textarea id="makewp005_theme_settings[home_content_area]" name="makewp005_theme_settings[home_content_area]" placeholder="<h1>Headline</h1><h2>Subhead</h2>" style="width: 99%;max-width:400px;height:200px;"><?php if (!empty($options['home_content_area'])) echo esc_textarea($options['home_content_area']); ?></textarea>

<br />
<label class="description abouttxtdescription" for="makewp005_theme_settings[home_content_area]"><?php _e( 'Enter text (can use html tags) for the home page in heading box-content.','makewp005'); ?></label>
</td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Head Text', 'makewp005' ); ?></th>
<td>
<textarea id="makewp005_theme_settings[home_headtxt]" name="makewp005_theme_settings[home_headtxt]" style="width: 99%;max-width:400px;height:100px;"><?php if (!empty($options['home_headtxt'])) echo esc_textarea($options['home_headtxt']); ?></textarea>

<br />
<label class="description abouttxtdescription" for="makewp005_theme_settings[home_headtxt]"><?php _e( 'Enter a brief call to action for the visitors also pay attention.','makewp005'); ?></label>
</td>
</tr>

<tr valign="top">
<th scope="row"><?php _e( 'Copyright', 'makewp005' ); ?></th>
<td>
<input id="makewp005_theme_settings[home_copy]" class="regular-text" type="text" size="36" name="makewp005_theme_settings[home_copy]" placeholder="Team MakeWP" value="<?php echo esc_textarea($options['home_copy']); ?>" />
<br />
<label class="description abouttxtdescription" for="makewp005_theme_settings[home_copy]"><?php _e( 'Enter your copyright text for the footer this site info.','makewp005'); ?></label>
</td>
</tr>

</table>
<p class="submit-changes">
<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'makewp005' ); ?>" />
</p>
</form>
</div><!--//wrap -->

<!--END GO Options-->

<?php
}
/*=Sanitize----------------------------------------------------*/
/*------------------------------------------------------------------*/
function makewp005_options_validate( $input ) {

	$output = $options = get_option( 'makewp005_theme_settings' );

                                $output['upload_mainlogo'] = esc_url_raw($input['upload_mainlogo']);
                                $output['home_tel'] = wp_kses_post($input['home_tel']);
                                $output['home_content_area'] = wp_kses_post($input['home_content_area']);
                                $output['home_headtxt'] = wp_kses_post($input['home_headtxt']);
		$output['home_copy'] = wp_filter_nohtml_kses($input['home_copy']);

	return apply_filters( 'makewp005_options_validate', $output, $input, $options );
}	
?>