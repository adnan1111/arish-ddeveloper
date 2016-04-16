<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package makewp005
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function makewp005_jetpack_setup() {
add_theme_support( 'infinite-scroll', array(
    'type'           => 'scroll',
    'footer' => 'page',
    'container'      => 'content'
) );
}
add_action( 'after_setup_theme', 'makewp005_jetpack_setup' );
