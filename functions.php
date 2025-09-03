<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

// GitHub Theme Updater
require_once get_template_directory() . '/includes/wp-theme-updater.php';


if ( ! function_exists('wp_theme_setup') ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @return void
	 */
	function wp_theme_setup() {
		
		// By adding theme support, we declare that this theme does not use a hard-coded <title> tag
		// in the document head, and expect WordPress to provide it for us.
		add_theme_support( 'title-tag' );
		
		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'search-form', 'navigation-widgets', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'
		) );
		
		// Add widget support shortcodes
		add_filter('widget_text', 'do_shortcode');
		
		// Support for Featured Images
		add_theme_support( 'post-thumbnails' );
		
		// Add support for core custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => [ 'site-title', 'site-description' ],
		) );
		
		// Add support for core custom header.
		add_theme_support( 'custom-header', array(
			'default-image'           => '',
			'default-text-color'      => '000',
			'header-text'             => false,
			'width'                   => 1920,
			'height'                  => 400,
			'flex-width'              => true,
			'flex-height'             => true
		) );
		
		// Add support for core custom background.
		add_theme_support( 'custom-background', array(
			'default-color' => '#ffffff',
		) );
		
		// This feature adds RSS feed links to HTML <head>
		add_theme_support( 'automatic-feed-links' );
		
		// Register Navigation Menu
		register_nav_menus( array(
			'header-primary'  => esc_html__( 'Header Menu', 'wp-theme' )
		) );
		
		// Add theme support WooCommerce
		add_theme_support( 'woocommerce' );
		
		// Add support for Block Editor styles.
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'custom-line-height' );
		add_theme_support( 'link-color' );
		add_theme_support( 'custom-spacing' );
		add_theme_support( 'custom-units' );
		
		// Editor Style
		add_theme_support( 'editor-style' );
	}
}
add_action( 'after_setup_theme', 'wp_theme_setup' );


/**
 * Enqueue Scripts and Styles for Front-End
 */
function wp_theme_scripts_and_styles(){
  wp_enqueue_script('jquery');

  // Special script for comments
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action('wp_enqueue_scripts', 'wp_theme_scripts_and_styles');


/**
 * Harden login error messages (prevent username discovery)
 */
add_filter( 'login_errors', static function() {
	return '<strong>ERROR</strong>: Stop guessing!';
});


/**
 * Remove WordPress version from various locations
 */
add_filter( 'the_generator', '__return_empty_string' );


/**
 * Hide WP version from RSS feeds
 */
add_filter( 'the_generator', function( $gen, $type ) {
	return ( $type === 'html' ) ? '' : $gen;
}, 10, 2 );


/**
 * Disable use XML-RPC & X-Pingback
 */
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'wp_headers', function( $headers ) {
	unset( $headers['X-Pingback'] );
	return $headers;
});