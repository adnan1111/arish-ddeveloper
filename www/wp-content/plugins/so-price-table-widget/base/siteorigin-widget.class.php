<?php

/**
 * Class SiteOrigin_Widget
 *
 * @author Greg Priday
 */
abstract class SiteOrigin_Widget extends WP_Widget {
	protected $form_options;
	protected $base_folder;
	protected $repeater_html;

	/**
	 * @var int How many seconds a CSS file is valid for.
	 */
	static $css_expire = 604800; // 7 days

	function __construct($id, $name, $widget_options = array(), $control_options = array(), $form_options = array(), $base_folder = false) {
		$this->form_options = $form_options;
		$this->base_folder = $base_folder;
		$this->repeater_html = array();
		parent::WP_Widget($id, $name, $widget_options, $control_options);
	}

	function form_options(){
		if( method_exists($this, 'modify_form' ) ) return $this->modify_form( $this->form_options );
		else return $this->form_options;
	}

	/**
	 * Display the widget.
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$style = $this->get_style_name( $instance );
		$hash = !empty($instance['style_hash']) ? $instance['style_hash'] : 'preview';
		$css_name = $this->id_base.'-'.$style.'-'.$hash;

		$upload_dir = wp_upload_dir();

		$this->clear_file_cache();

		if($hash == 'preview') {
			siteorigin_widget_add_inline_css( $this->get_instance_css( $instance ) );
		}
		else {
			if( !file_exists( $upload_dir['basedir'] . '/siteorigin-widgets/' . $css_name .'.css' ) ) {
				// Attempt to recreate the CSS
				$this->save_css($instance);
			}

			if( file_exists( $upload_dir['basedir'] . '/siteorigin-widgets/' . $css_name .'.css' ) ) {
				wp_enqueue_style(
					$css_name,
					$upload_dir['baseurl'] . '/siteorigin-widgets/' . $css_name .'.css'
				);
			}
			else {
				// Fall back to using inline CSS if we can't find the cached CSS file.
				siteorigin_widget_add_inline_css( $this->get_instance_css( $instance ) );
			}
		}

		if( method_exists( $this, 'enqueue_frontend_scripts' ) ) {
			$this->enqueue_frontend_scripts();
		}

		echo $args['before_widget'];
		echo '<div class="so-widget-'.$css_name.'">';
		@ include $this->base_folder . '/tpl/' . $this->get_template_name($instance) . '.php';
		echo '</div>';
		echo $args['after_widget'];
	}

	/**
	 * Display the widget form.
	 *
	 * @param array $instance
	 * @return string|void
	 */
	public function form( $instance ) {
		static $enqueued = false;

		if(empty($enqueued )){
			$this->enqueue_scripts();
			$enqueued = true;
		}

		$form_id = 'siteorigin_widget_form_'.md5( uniqid( rand(), true ) );
		$class_name = str_replace('_', '-', strtolower(get_class($this)));

		?>
		<div class="siteorigin-widget-form siteorigin-widget-form-main siteorigin-widget-form-main-<?php echo esc_attr($class_name) ?>" id="<?php echo $form_id ?>" data-class="<?php echo get_class($this) ?>">
			<?php
			foreach( $this->form_options() as $field_name => $field) {
				$this->render_field(
					$field_name,
					$field,
					isset($instance[$field_name]) ? $instance[$field_name] : false,
					false
				);
			}
			?>

		</div>


		<script type="text/javascript">
			( function($){
				if(typeof window.sow_repeater_html == 'undefined') window.sow_repeater_html = {};
				window.sow_repeater_html["<?php echo get_class($this) ?>"] = <?php echo json_encode($this->repeater_html) ?>;
				if(typeof $.fn.sowSetupForm != 'undefined') { $('#<?php echo $form_id ?>').sowSetupForm(); }
			} )( jQuery );
		</script>
		<?php
	}

	function enqueue_scripts(){
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'siteorigin-widget-admin', plugin_dir_url(SITEORIGIN_WIDGETS_BASE_PARENT_FILE).'base/css/admin.css', array(), SITEORIGIN_WIDGETS_BASE_VERSION );

		wp_enqueue_script( 'wp-color-picker');
		wp_enqueue_script( 'siteorigin-widget-admin', plugin_dir_url(SITEORIGIN_WIDGETS_BASE_PARENT_FILE) . 'base/js/admin.min.js', array( 'jquery', 'jquery-ui-sortable' ), SITEORIGIN_WIDGETS_BASE_VERSION );

		wp_localize_script( 'siteorigin-widget-admin', 'soWidgets', array(
			'sure' => __('Are you sure?', 'siteorigin-widgets')
		) );

		if(method_exists($this, 'enqueue_admin_scripts')) {
			// Let the widget enqueue its own scripts and styles
			$this->enqueue_admin_scripts();
		}
	}

	/**
	 * Update the widget instance.
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array|void
	 */
	public function update( $new_instance, $old_instance ) {
		if( !class_exists('SiteOrigin_Widgets_Color_Object') ) require plugin_dir_path( __FILE__ ).'inc/color.php';

		$new_instance = $this->sanitize($new_instance, $this->form_options());
		$new_instance['style_hash'] = $this->get_style_hash($new_instance);

		$this->save_css($new_instance);

		return $new_instance;
	}

	/**
	 * Save the CSS to the filesystem
	 *
	 * @param $instance
	 * @return bool|string
	 */
	public function save_css( $instance ){
		require_once ABSPATH . 'wp-admin/includes/file.php';

		if( WP_Filesystem() ) {
			global $wp_filesystem;
			$upload_dir = wp_upload_dir();

			if( !$wp_filesystem->is_dir( $upload_dir['basedir'] . '/siteorigin-widgets/' ) ) {
				$wp_filesystem->mkdir( $upload_dir['basedir'] . '/siteorigin-widgets/' );
			}

			$style = $this->get_style_name($instance);
			$hash = $this->get_style_hash( $instance );

			$name = $this->id_base.'-'.$style.'-'.$hash.'.css';

			$css = $this->get_instance_css($instance);

			$wp_filesystem->delete($upload_dir['basedir'] . '/siteorigin-widgets/'.$name);
			$wp_filesystem->put_contents(
				$upload_dir['basedir'] . '/siteorigin-widgets/'.$name,
				$css
			);

			return $hash;
		}
		else {
			return false;
		}
	}

	/**
	 * Clear all old CSS files
	 */
	public function clear_file_cache(){
		static $done = false;

		if( !$done && !get_transient('sow:cleared') ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
			if( WP_Filesystem() ) {
				global $wp_filesystem;
				$upload_dir = wp_upload_dir();

				$list = $wp_filesystem->dirlist( $upload_dir['basedir'] . '/siteorigin-widgets/' );
				foreach($list as $file) {
					if( $file['lastmodunix'] < time() - self::$css_expire ) {
						// Delete the file
						$wp_filesystem->delete( $upload_dir['basedir'] . '/siteorigin-widgets/' . $file['name'] );
					}
				}
			}

			set_transient('sow:cleared', true, self::$css_expire);
		}

		$done = true;
	}

	/**
	 * Generate the CSS for the widget.
	 *
	 * @param $instance
	 * @return string
	 */
	public function get_instance_css( $instance ){
		if( !class_exists('lessc') ) require plugin_dir_path( __FILE__ ).'inc/lessc.inc.php';

		$less = file_get_contents( $this->base_folder.'styles/'.$this->get_style_name($instance).'.less' );

		// Substitute the variables
		$vars = $this->get_less_variables($instance);
		if( !empty( $vars ) ){
			foreach($vars as $name => $value) {
				if(empty($value)) continue;
				$less = preg_replace('/\@'.preg_quote($name).' *\:.*?;/', '@'.$name.': '.$value.';', $less);
			}
		}

		$mixins = file_get_contents(plugin_dir_path(__FILE__).'less/mixins.less');
		$less = str_replace('@import "../base/less/mixins";', $mixins, $less);


		$style = $this->get_style_name( $instance );
		if(empty($instance['style_hash'])) $instance['style_hash'] = $this->get_style_hash( $instance );

		$css_name = $this->id_base.'-'.$style.'-'.$instance['style_hash'];

		$less = '.so-widget-'.$css_name.' { '.$less.' } ';

		$c = new lessc();
		return $c->compile($less);
	}

	/**
	 * @param $instance
	 * @param $fields
	 */
	public function sanitize( $instance, $fields ) {
		foreach($fields as $name => $field) {
			if(empty($instance[$name])) $instance[$name] = false;
			elseif($field['type'] == 'select') {
				// Make sure that the value is in the options
			}
			elseif($field['type'] == 'repeater') {
				foreach($instance[$name] as $i => $sub_instance) {
					$instance[$name][$i] = $this->sanitize($sub_instance, $field['fields']);
				}
			}
			elseif( isset($field['sanitize']) ) {
				switch($field['sanitize']) {
					case 'url':
						$instance[$name] = esc_url_raw($instance[$name]);
						break;
				}
			}
		}

		return $instance;
	}

	/**
	 * @param $field_name
	 * @param array $repeater
	 * @param string $repeater_append
	 * @return mixed|string
	 */
	public function so_get_field_name($field_name, $repeater = array(), $repeater_append = '[]') {
		if( empty($repeater) ) return $this->get_field_name($field_name);
		else {

			$repeater_extras = '';
			foreach($repeater as $r) {
				$repeater_extras .= '['.$r.'][#'.$r.'#]';
			}

			$name = $this->get_field_name('{{{FIELD_NAME}}}');
			$name = str_replace('[{{{FIELD_NAME}}}]', $repeater_extras.'['.esc_attr($field_name).']', $name);
			return $name;
		}
	}

	/**
	 * Render a form field
	 *
	 * @param $name
	 * @param $field
	 * @param $value
	 * @param array $repeater
	 */
	function render_field( $name, $field, $value, $repeater = array() ){
		?><div class="siteorigin-widget-field siteorigin-widget-field-<?php echo sanitize_html_class($name) ?>"><?php

		if($field['type'] != 'repeater' && $field['type'] != 'checkbox') {
			?><label><?php echo $field['label'] ?></label><?php
		}

		switch( $field['type'] ) {
			case 'text' :
				?><input type="text" name="<?php echo $this->so_get_field_name($name, $repeater) ?>" value="<?php echo esc_attr($value) ?>" class="widefat siteorigin-widget-input" /><?php
				break;

			case 'color' :
				?><input type="text" name="<?php echo $this->so_get_field_name($name, $repeater) ?>" value="<?php echo esc_attr($value) ?>" class="widefat siteorigin-widget-input siteorigin-widget-input-color" /><?php
				break;

			case 'textarea' :
				?><textarea type="text" name="<?php echo $this->so_get_field_name($name, $repeater) ?>" class="widefat siteorigin-widget-input" rows="<?php echo !empty($field['rows']) ? intval($field['rows']) : 4 ?>"><?php echo esc_textarea($value) ?></textarea><?php
				break;

			case 'select':
				?>
				<select name="<?php echo $this->so_get_field_name($name, $repeater) ?>" class="siteorigin-widget-input">
					<?php foreach( $field['options'] as $v => $t ) : ?>
						<option value="<?php echo esc_attr($v) ?>" <?php selected($v, $value) ?>><?php echo esc_html($t) ?></option>
					<?php endforeach; ?>
				</select>
				<?php
				break;

			case 'checkbox':
				?>
				<label>
					<input type="checkbox" name="<?php echo $this->so_get_field_name($name, $repeater) ?>" class="siteorigin-widget-input" <?php checked( !empty( $value ) ) ?> />
					<?php echo $field['label'] ?>
				</label>
				<?php
				break;

			case 'media':
				if( version_compare( get_bloginfo('version'), '3.5', '<' ) ){
					printf(__('You need to <a href="%s">upgrade</a> to WordPress 3.5 to use media fields', 'siteorigin'), admin_url('update-core.php'));
					break;
				}

				if(!empty($value)) {
					if(is_array($value)) {
						$src = $value;
					}
					else {
						$post = get_post($value);
						$src = wp_get_attachment_image_src($value, 'thumbnail');
						if(empty($src)) $src = wp_get_attachment_image_src($value, 'thumbnail', true);
					}
				}
				else{
					$src = array('', 0, 0);
				}

				$choose_title = empty($args['choose']) ? __('Choose Media', 'siteorigin-widgets') : $args['choose'];
				$update_button = empty($args['update']) ? __('Set Media', 'siteorigin-widgets') : $args['update'];

				?>
				<div class="media-field-wrapper">
					<div class="current">
						<div class="thumbnail-wrapper">
							<img src="<?php echo esc_url( $src[0] ) ?>" class="thumbnail" <?php if( empty( $src[0] ) ) echo "style='display:none'" ?> />
						</div>
						<div class="title"><?php if( !empty( $post ) ) echo esc_attr( $post->post_title ) ?></div>
					</div>
					<a href="#" class="media-upload-button" data-choose="<?php echo esc_attr($choose_title) ?>" data-update="<?php echo esc_attr( $update_button ) ?>">
						<?php echo esc_html($choose_title) ?>
					</a>

					<a href="#" class="media-remove-button"><?php _e('Remove', 'siteorigin') ?></a>
				</div>

				<input type="hidden" value="<?php echo esc_attr( is_array( $value ) ? '-1' : $value ) ?>" name="<?php echo $this->so_get_field_name( $name, $repeater ) ?>" class="siteorigin-widget-input" />
				<div class="clear"></div>
				<?php
				break;

			case 'repeater':
				ob_start();
				$repeater[] = $name;
				foreach($field['fields'] as $sub_field_name => $sub_field) {
					$this->render_field(
						$sub_field_name,
						$sub_field,
						isset($value[$sub_field_name]) ? $value[$sub_field_name] : false,
						$repeater
					);
				}
				$html = ob_get_clean();

				$this->repeater_html[$name] = $html;

				?>
				<div class="siteorigin-widget-field-repeater" data-item-name="<?php echo esc_attr( $field['item_name'] ) ?>" data-repeater-name="<?php echo esc_attr($name) ?>">
					<div class="siteorigin-widget-field-repeater-top">
						<div class="siteorigin-widget-field-repeater-expend"></div>
						<h3><?php echo $field['label'] ?></h3>
					</div>
					<div class="siteorigin-widget-field-repeater-items">
						<?php
						if( !empty( $value ) ) {
							foreach( $value as $v ) {
								?>
								<div class="siteorigin-widget-field-repeater-item">
									<div class="siteorigin-widget-field-repeater-item-top">
										<div class="siteorigin-widget-field-repeater-item-expand"></div>
										<div class="siteorigin-widget-field-repeater-item-remove"></div>
										<h4><?php echo esc_html($field['item_name']) ?></h4>
									</div>
									<div class="siteorigin-widget-field-repeater-item-form">
										<?php
										foreach($field['fields'] as $sub_field_name => $sub_field) {
											$this->render_field(
												$sub_field_name,
												$sub_field,
												isset($v[$sub_field_name]) ? $v[$sub_field_name] : false,
												$repeater
											);
										}
										?>
									</div>
								</div>
								<?php
							}
						}
						?>
					</div>
					<div class="siteorigin-widget-field-repeater-add"><?php _e('Add', 'siteorigin-widgets') ?></div>
				</div>
				<?php
				break;
		}

		?></div><?php
	}

	/**
	 * Parse markdown
	 *
	 * @param $markdown
	 * @return string The HTML
	 */
	function parse_markdown($markdown){
		if( !class_exists('Markdown_Parser') ) include plugin_dir_path(__FILE__).'inc/markdown.php';
		$parser = new Markdown_Parser();

		return $parser->transform($markdown);
	}

	/**
	 * Get a hash that makes the design unique
	 *
	 * @param $instance
	 * @return string
	 */
	abstract function get_style_hash($instance);

	/**
	 * Get the template name that we'll be using to render this widget.
	 *
	 * @param $instance
	 * @return mixed
	 */
	abstract function get_template_name($instance);

	/**
	 * Get the template name that we'll be using to render this widget.
	 *
	 * @param $instance
	 * @return mixed
	 */
	abstract function get_style_name($instance);

	/**
	 * Get any variables that need to be substituted by
	 *
	 * @param $instance
	 * @return array
	 */
	function get_less_variables($instance){
		return array();
	}

}