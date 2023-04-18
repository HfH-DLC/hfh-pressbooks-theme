<?php

/**
 * HfH Pressbooks Theme functions and definitions
 * 
 * @package HFH Pressbooks Theme
 * @license GPL 2.0+
 */

if (!defined('HFH_PRESSBOOKS_THEME_VERSION')) {
	// Replace the version number of the theme on each release.
	define('HFH_PRESSBOOKS_THEME_VERSION', '1.0.14');
}

require_once 'inc/class-book.php';

/**
 * Initial theme setup.
 */
function hfh_pressbooks_theme_theme_setup()
{
	// Add theme support for special features here.
}

add_action('after_setup_theme', 'hfh_pressbooks_theme_theme_setup');

/**
 * Enqueue scripts and styles.
 */
function hfh_pressbooks_theme_enqueue_scripts()
{
	wp_enqueue_style('hfh-pressbook-theme-style-index', get_stylesheet_directory_uri() . '/dist/main.css', array(), HFH_PRESSBOOKS_THEME_VERSION);
	$options    = get_option('pressbooks_theme_options_global');
	$custom_css = "
                :root {
                        --textbox-examples: {$options['edu_textbox_examples_header_background']};
						--textbox-objectives: {$options['edu_textbox_objectives_header_background']};
						--textbox-exercises: {$options['edu_textbox_exercises_header_background']};
						--textbox-takeaways: {$options['edu_textbox_takeaways_header_background']};
                }";
	wp_add_inline_style('hfh-pressbook-theme-style-index', $custom_css);

	if (!is_front_page()) {
		$web_options = get_option('pressbooks_theme_options_web');
		if (isset($web_options['collapse_sections']) && absint($web_options['collapse_sections']) === 1) {
			wp_dequeue_script('pressbooks/collapse-sections');
			wp_deregister_script('pressbooks/collapse-sections');
			wp_enqueue_script('pressbooks/collapse-sections', get_stylesheet_directory_uri() . '/js/collapse-sections.js', array(), HFH_PRESSBOOKS_THEME_VERSION, true);
		}
	}
}

add_action('wp_enqueue_scripts', 'hfh_pressbooks_theme_enqueue_scripts', 11);

/**
 * Add editor styles
 */
function hfh_pressbooks_theme_add_editor_styles()
{
	add_editor_style('dist/editor.css');
}

add_action('after_setup_theme', 'hfh_pressbooks_theme_add_editor_styles');


/**
 * Changes default colors for the different textboxes
 * 
 * @param array $default_options The default theme options.
 */
function hfh_pressbooks_theme_options_global_defaults($default_options)
{
	return array_merge(
		$default_options,
		array(
			'edu_textbox_examples_header_color'        => '#FFF',
			'edu_textbox_examples_header_background'   => '#3a6f92',
			'edu_textbox_examples_background'          => '#dbeffd',
			'edu_textbox_exercises_header_color'       => '#FFF',
			'edu_textbox_exercises_header_background'  => '#BE1925',
			'edu_textbox_exercises_background'         => '#F8E8E9',
			'edu_textbox_objectives_header_color'      => '#FFF',
			'edu_textbox_objectives_header_background' => '#57751c',
			'edu_textbox_objectives_background'        => '#eef5e0',
			'edu_textbox_takeaways_header_color'       => '#FFF',
			'edu_textbox_takeaways_header_background'  => '#14776c',
			'edu_textbox_takeaways_background'         => '#ecf9f7',
		)
	);
}

add_filter(
	'pb_theme_options_global_defaults',
	'hfh_pressbooks_theme_options_global_defaults',
	11
);

/**
 * Loads css for H5P.
 * 
 * @param array $styles The array of css files to be loaded.
 */
function hfh_pressbooks_theme_alter_styles(&$styles)
{
	$styles[] = (object) array(
		'path'    => get_stylesheet_directory_uri() . '/dist/h5p.css',
	);
}
add_action('h5p_alter_library_styles', 'hfh_pressbooks_theme_alter_styles', 10, 3);

/**
 * Removes the h1 option from the richtext editor
 * 
 * @param array $args the array of arguments.
 */
function hfh_pressbooks_theme_remove_h1($args)
{
	$args['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Pre=pre';
	return $args;
}
add_filter('tiny_mce_before_init', 'hfh_pressbooks_theme_remove_h1');


function custom_excerpt_more($more)
{
	return ' [&hellip;]';
}
add_filter('excerpt_more', 'custom_excerpt_more', 11);

function hfh_pressbooks_theme_remove_protected_text()
{
	return '%s';
}

add_filter('protected_title_format', 'hfh_pressbooks_theme_remove_protected_text');

/**
 * Tag the subsections, used instead of pressbooks pb_tag_subsections
 *
 * @param $content string
 *
 * @return string
 */
function hfh_tag_subsections($content, $id)
{
	$tagged_content = \HfH_Pressbooks_Theme\Book::tagSubsections($content, $id);
	return ($tagged_content === false) ? $content : $tagged_content;
}
