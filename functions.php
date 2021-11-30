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


/**
 * Changes default colors for the different textboxes
 * 
 * @param array $default_options The default theme options.
 */
function hfh_pressbooks_theme_options_global_defaults( $default_options ) {
	return array_merge(
		$default_options,
		array(
			'edu_textbox_examples_header_color'        => '#FFF',
			'edu_textbox_examples_header_background'   => '#005999',
			'edu_textbox_examples_background'          => '#dbeffd',
			'edu_textbox_exercises_header_color'       => '#FFF',
			'edu_textbox_exercises_header_background'  => '#BE1925',
			'edu_textbox_exercises_background'         => '#F8E8E9',
			'edu_textbox_objectives_header_color'      => '#FFF',
			'edu_textbox_objectives_header_background' => '#306100',
			'edu_textbox_objectives_background'        => '#e2edc7',
			'edu_textbox_takeaways_header_color'       => '#FFF',
			'edu_textbox_takeaways_header_background'  => '#5F37AE',
			'edu_textbox_takeaways_background'         => '#f1ebff',
		)
	);
}

add_filter(
	'pb_theme_options_global_defaults',
	'hfh_pressbooks_theme_options_global_defaults',
	11
);
