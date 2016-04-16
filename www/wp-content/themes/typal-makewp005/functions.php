<?php

/**
 * makewp005 functions and definitions
 *
 * @package makewp005
 */

/**
 * Options Theme admin
 */
require(get_template_directory() . '/theme-options/theme-admin.php');

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 700; /* pixels */

if ( ! function_exists( 'makewp005_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function makewp005_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on makewp005, use a find and replace
	 * to change 'makewp005' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'makewp005', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Editor styles for the win
	 */
	add_editor_style( 'css/editor-style.css' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
                set_post_thumbnail_size( 200, 150, true );
                add_image_size( 'makewp005-medium', 210, 95, true );
	add_image_size( 'makewp005-small', 75, 75, true );
                add_image_size( 'makewp005-big', 700, 400, true );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
	        'primary' => __( 'Primary Menu', 'makewp005' ),
	        'sub-menu'  => __('Sub Menu', 'makewp005'),
	        'footer-menu'      => __('Footer Menu', 'makewp005')
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'image', 'video', 'audio', 'quote', 'link', 'aside', 'status', 'gallery' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'makewp005_custom_background_args', array(
		'default-color' => 'eaeaea',
		'default-image' => get_template_directory_uri().'/img/bg.png',
	) ) );
}
endif; // makewp005_setup
add_action( 'after_setup_theme', 'makewp005_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function makewp005_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'makewp005' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

       register_sidebar(array(
            'name' => __('Bottom1 Home', 'makewp005'),
            'description' => __('Located at the bottom left of the home page', 'makewp005'),
            'id' => 'bottom1',
            'before_title' => '<p class="mini-title">',
            'after_title' => '</p>',
            'before_widget' => '',
            'after_widget' => ''
        ));

       register_sidebar(array(
            'name' => __('Bottom2 Home', 'makewp005'),
            'description' => __('Located at the bottom right of the home page', 'makewp005'),
            'id' => 'bottom2',
            'before_title' => '<p class="mini-title">',
            'after_title' => '</p>',
            'before_widget' => '',
            'after_widget' => ''
        ));

       register_sidebar(array(
            'name' => __('Footer1', 'makewp005'),
            'description' => __('Located in the footer left of the page. Best for footer menu.', 'makewp005'),
            'id' => 'footer1',
            'before_title' => '<span class="hidden">',
            'after_title' => '</span>',
            'before_widget' => '<div class="footerwidget-left">',
            'after_widget' => '</div>'
        ));

       register_sidebar(array(
            'name' => __('Footer2', 'makewp005'),
            'description' => __('Located in the footer right of the page. Best for social widger or short text.', 'makewp005'),
            'id' => 'footer2',
            'before_title' => '<span class="hidden">',
            'after_title' => '</span>',
            'before_widget' => '<div class="footerwidget-right">',
            'after_widget' => '</div>'
        ));


}
add_action( 'widgets_init', 'makewp005_widgets_init' );

/**
 * Enqueue scripts
 */
function makewp005_scripts() {
                wp_enqueue_style( 'makewp005-style', get_stylesheet_uri() );
	wp_enqueue_script( 'makewp005-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'makewp005-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
                wp_enqueue_style( 'dsc-googlefonts', 'http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic&subset=latin,cyrillic|Ubuntu:400,500,700&subset=latin,cyrillic' );
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css' );//Genericons include

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'makewp005-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'makewp005_scripts' );

/*=SuperFish
*/
add_action( 'wp_enqueue_scripts', 'superfish_libs' );  
function superfish_libs()  
{  
    // Register each script, setting appropriate dependencies  
    wp_register_script('supersubs',   get_template_directory_uri() . '/superfish-js/superfish.min.js'); 

    // Enqueue supersubs, we don't need to enqueue any others in this case, as the dependencies take care of it for us  
    wp_enqueue_script('supersubs'); 
 
    // Register each style, setting appropriate dependencies 
    wp_register_style('superfishbase',   get_template_directory_uri() . '/superfish-css/superfish.css'); 
    wp_register_style('superfishvert',   get_template_directory_uri() . '/superfish-css/superfish-vertical.css', array( 'superfishbase' )); 
    wp_register_style('superfishnavbar', get_template_directory_uri() . '/superfish-css/superfish-navbar.css', array( 'superfishvert' )); 
 
    // Enqueue superfishnavbar, we don't need to enqueue any others in this case either, as the dependencies take care of it  
    wp_enqueue_style('superfishnavbar');  
} 

/*=Excerpt
*/
function new_excerpt_length($length) { 
	return 23; }
add_filter('excerpt_length', 'new_excerpt_length');

function new_excerpt_more($excerpt) { 
	return str_replace('[...]', '...', $excerpt); }
add_filter('wp_trim_excerpt', 'new_excerpt_more');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';

