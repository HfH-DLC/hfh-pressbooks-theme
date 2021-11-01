<?php
/**
 * HfH Pressbooks Theme functions and definitions
 * 
 * @package HFH Pressbooks Theme
 * @license GPL 2.0+
 */

if ( ! defined( 'HFH_PRESSBOOKS_THEME_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'HFH_PRESSBOOKS_THEME_VERSION', '0.1.0' );
}

/**
 * Initial theme setup.
 */
function hfh_pressbooks_theme_theme_setup() {
	// Add theme support for special features here.
}

add_action( 'after_setup_theme', 'hfh_pressbooks_theme_theme_setup' );

/**
 * Enqueue scripts and styles.
 */
function hfh_pressbooks_theme_enqueue_scripts() {
	wp_enqueue_style( 'hfh-pressbook-theme-style-index', get_stylesheet_directory_uri() . '/css/index.css', array(), HFH_PRESSBOOKS_THEME_VERSION );
}

add_action( 'wp_enqueue_scripts', 'hfh_pressbooks_theme_enqueue_scripts', 11 );
