<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package ul
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function ul_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'ul_jetpack_setup' );
