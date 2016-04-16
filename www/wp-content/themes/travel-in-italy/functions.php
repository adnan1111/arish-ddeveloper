<?php

/**
 * travelinitaly functions and definitions
 *
 * @package HospitalityWeb
 * @subpackage Travel_in_Italy
 * @since Travel in Italy 1.0.2
 */

require_once('widgets/ads_widget.php');

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640;

/** Tell WordPress to run travelinitaly_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'travelinitaly_setup' );

if ( ! function_exists( 'travelinitaly_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @uses add_theme_support() To add support for post thumbnails, custom headers and backgrounds, and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses load_theme_textdomain() For translation/localization support.
 *
 * @since Travel in Italy 1.0.2
 */
function travelinitaly_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true );
	add_image_size( 'big_thumb', 300, 300 );
	add_image_size( 'showcase_thumb', 980, 460, true );
	add_image_size( 'popular_thumb', 300, 190, true );
	add_image_size( 'post_thumb', 582, 582 );
	
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'travelinitaly', get_template_directory() . '/languages' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'travelinitaly' ),
	) );
	
	// Add support for custom headers.
	add_theme_support( 'custom-header', array(
		'default-image' => get_template_directory_uri().'/images/header-italia.png',
		'width' => 418,
		'height' => 134,
		'flex-height' => true,
		'flex-width' => true,
		'header-text' => false
	) );
	if ( ! function_exists( 'get_custom_header' ) ) {
		// This is all for compatibility with versions of WordPress prior to 3.4.
		define( 'HEADER_IMAGE', '' );
		define( 'HEADER_IMAGE_WIDTH', 418 );
		define( 'HEADER_IMAGE_HEIGHT', 134 );
		add_theme_support( 'custom-header' );
	}
}
endif;

function travelinitaly_scripts() {
	wp_enqueue_script( 'jquery_cycle', get_template_directory_uri().'/js/jquery.cycle.all.js', array('jquery') );
	wp_enqueue_style( 'dosis', 'http://fonts.googleapis.com/css?family=Dosis' );
	wp_enqueue_style( 'raleway', 'http://fonts.googleapis.com/css?family=Raleway:400,700' );
}
add_action( 'wp_enqueue_scripts', 'travelinitaly_scripts' );

function travelinitaly_custom_admin_css() {
	echo '<style>
  	.appearance_page_custom-header #headimg { background-color:#54C0D1; }
 	</style>';
}
add_action('admin_head', 'travelinitaly_custom_admin_css');

/**************************************************
 *	LOGIN WINDOW
 **************************************************/

function travelinitaly_custom_login_logo() {
  echo '<style type="text/css">
  body.login { background:#54C0D1; }
  .login h1 a { height:180px; background-size:300px 167px; background-image:url('.get_bloginfo('template_directory').'/images/logo_login.png) !important; }
  .login #nav, .login #backtoblog { text-shadow:none; }
  </style>';
}
add_action('login_head', 'travelinitaly_custom_login_logo');	

/**************************************************
 *	TAG CLOUD
 **************************************************/

function travelinitaly_tag_cloud_args($in){
	return 'smallest=13&largest=13&number=25&orderby=count&order=RAND&unit=px';
}
add_filter( 'widget_tag_cloud_args', 'travelinitaly_tag_cloud_args');

/**************************************************
 *	META BOX
 **************************************************/

function travelinitaly_add_custom_box() {
    $screens = array( 'post' );
    foreach( $screens as $screen ) {
        add_meta_box(
            'myplugin_sectionid',
            __( 'Display options', 'travelinitaly' ),
            'travelinitaly_inner_custom_box',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'travelinitaly_add_custom_box' );

function travelinitaly_inner_custom_box( $post ) {
	wp_nonce_field( 'travelinitaly_inner_custom_box', 'travelinitaly_inner_custom_box_nonce' );
	
	// Show in showcase
  	$value = get_post_meta( $post->ID, '_in_showcase', true );
  	echo '<input type="checkbox" id="travelinitaly_in_showcase" name="travelinitaly_in_showcase" value="1" '.($value==1 ? 'checked="checked" ': '').'/>';
	echo ' <label for="travelinitaly_in_showcase">'.__( "Show in showcase", 'travelinitaly' ).'</label><br />';
	
	// Show in popular posts
	$value = get_post_meta( $post->ID, '_in_popular', true );
  	echo '<input type="checkbox" id="travelinitaly_in_popular" name="travelinitaly_in_popular" value="1" '.($value==1 ? 'checked="checked" ': '').'/>';
	echo ' <label for="travelinitaly_in_popular">'.__( "Show in popular posts", 'travelinitaly' ).'</label><br />';
}

function travelinitaly_save_postdata( $post_id ) {
	if(!isset( $_POST['travelinitaly_inner_custom_box_nonce'] )) return $post_id;
  	$nonce = $_POST['travelinitaly_inner_custom_box_nonce'];
  	if(!wp_verify_nonce( $nonce, 'travelinitaly_inner_custom_box' )) return $post_id;
  	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;
  	if( 'page' == $_POST['post_type'] ) {
    	if(!current_user_can( 'edit_page', $post_id )) return $post_id;
  	} else {
    	if(!current_user_can( 'edit_post', $post_id )) return $post_id;
  	}

  	// Show in showcase
  	$mydata = sanitize_text_field( $_POST['travelinitaly_in_showcase'] );
  	update_post_meta( $post_id, '_in_showcase', $mydata );
	
	// Show in popular posts
	$mydata = sanitize_text_field( $_POST['travelinitaly_in_popular'] );
  	update_post_meta( $post_id, '_in_popular', $mydata );
}
add_action( 'save_post', 'travelinitaly_save_postdata' );

/**************************************************
 *	COLUMNS IN POSTS LIST
 **************************************************/
 
add_filter('manage_posts_columns', 'travelinitaly_posts_columns');
function travelinitaly_posts_columns($columns) {
    $columns['display_options'] = __("Show in...",'travelinitaly');
    return $columns;
}

add_action('manage_posts_custom_column', 'travelinitaly_show_posts_columns');
function travelinitaly_show_posts_columns($name) {
    global $post;
    switch ($name) {
    case 'display_options':
    	$in_showcase = get_post_meta( $post->ID, '_in_showcase', true );
       	if($in_showcase==1) echo '<span style="color:#900">'.__("Showcase",'travelinitaly').'</span><br />';
		$in_popular = get_post_meta( $post->ID, '_in_popular', true );
		if($in_popular==1) echo '<span style="color:#090">'.__("Popular posts",'travelinitaly').'</span><br />';    
		break;
    }
}
		
/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Travel in Italy 1.0.2
 */
function travelinitaly_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'travelinitaly_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Travel in Italy 1.0.2
 * @return int
 */
function travelinitaly_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'travelinitaly_excerpt_length' );

if ( ! function_exists( 'travelinitaly_continue_reading_link' ) ) :
/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Travel in Italy 1.0.2
 * @return string "Continue Reading" link
 */
function travelinitaly_continue_reading_link() {
	return ' <a href="'.get_permalink().'">'.__( '(read more)', 'travelinitaly' ).'</a>';
}
endif;

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and travelinitaly_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Travel in Italy 1.0.2
 * @return string An ellipsis
 */
function travelinitaly_auto_excerpt_more( $more ) {
	return ' &hellip;' . travelinitaly_continue_reading_link();
}
add_filter( 'excerpt_more', 'travelinitaly_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Travel in Italy 1.0.2
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function travelinitaly_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= travelinitaly_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'travelinitaly_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Travel in Italy's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 * @since Travel in Italy 1.0.2
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 *
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 *
 * @since Travel in Italy 1.0.2
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function travelinitaly_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'travelinitaly_remove_gallery_css' );

if ( ! function_exists( 'travelinitaly_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own travelinitaly_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Travel in Italy 1.0.2
 */
function travelinitaly_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 40 ); ?>
				<?php printf( __( '%s <span class="says">says:</span>', 'travelinitaly' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</div><!-- .comment-author .vcard -->
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'travelinitaly' ); ?></em>
				<br />
			<?php endif; ?>

			<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s at %2$s', 'travelinitaly' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'travelinitaly' ), ' ' );
				?>
			</div><!-- .comment-meta .commentmetadata -->

			<div class="comment-body"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'travelinitaly' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'travelinitaly' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override travelinitaly_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Travel in Italy 1.0.2
 * @uses register_sidebar
 */
function travelinitaly_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'travelinitaly' ),
		'id' => 'primary-widget-area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'travelinitaly' ),
		'id' => 'footer-widget-area',
		'description' => __( 'Max three widgets', 'travelinitaly' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running travelinitaly_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'travelinitaly_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * This function uses a filter (show_recent_comments_widget_style) new in WordPress 3.1
 * to remove the default style. Using Travel in Italy 1.0.2 in WordPress 3.0 will show the styles,
 * but they won't have any effect on the widget in default Travel in Italy styling.
 *
 * @since Travel in Italy 1.0.2
 */
function travelinitaly_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'travelinitaly_remove_recent_comments_style' );

if ( ! function_exists( 'travelinitaly_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Travel in Italy 1.0.2
 */
function travelinitaly_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'travelinitaly' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'travelinitaly' ), get_the_author() ) ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'travelinitaly_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Travel in Italy 1.0.2
 */
function travelinitaly_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'travelinitaly' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'travelinitaly' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'travelinitaly' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/**
 * Retrieves the IDs for images in a gallery.
 *
 * @uses get_post_galleries() first, if available. Falls back to shortcode parsing,
 * then as last option uses a get_posts() call.
 *
 * @since Travel in Italy 1.0.2
 *
 * @return array List of image IDs from the post gallery.
 */
function travelinitaly_get_gallery_images() {
	$images = array();

	if ( function_exists( 'get_post_galleries' ) ) {
		$galleries = get_post_galleries( get_the_ID(), false );
		if ( isset( $galleries[0]['ids'] ) )
		 	$images = explode( ',', $galleries[0]['ids'] );
	} else {
		$pattern = get_shortcode_regex();
		preg_match( "/$pattern/s", get_the_content(), $match );
		$atts = shortcode_parse_atts( $match[3] );
		if ( isset( $atts['ids'] ) )
			$images = explode( ',', $atts['ids'] );
	}

	if ( ! $images ) {
		$images = get_posts( array(
			'fields'         => 'ids',
			'numberposts'    => 999,
			'order'          => 'ASC',
			'orderby'        => 'menu_order',
			'post_mime_type' => 'image',
			'post_parent'    => get_the_ID(),
			'post_type'      => 'attachment',
		) );
	}

	return $images;
}
