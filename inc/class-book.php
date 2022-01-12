<?php
/**
 * A book is a discrete, collection of text (and other media), that is designed by an author(s) as an internally
 * complete representation of an idea, or set of ideas; emotion or set of emotions; and transmitted to readers in
 * various formats.
 *
 * @author  Pressbooks <code@pressbooks.com>
 * @license GPLv3 (or any later version)
 */

namespace HfH_Pressbooks_Theme;

use Pressbooks\Modules\Export\Export;
use Pressbooks\HtmlParser;

class Book {

	const SUBSECTIONS_TRANSIENT           = 'pb_book_subsections';
	const SUBSECTION_PROCESSING_TRANSIENT = 'pb_getting_all_subsections';


	/**
	 * Returns an array of front matter, chapters, and back matter which contain subsections.
	 *
	 * @param array $book_structure The book structure from getBookStructure()
	 * @return array The subsections, grouped by parent post type
	 */
	static function getAllSubsections( $book_structure ) {
		if ( Export::shouldParseSubsections() ) {
			$book_subsections_transient      = self::SUBSECTIONS_TRANSIENT;
			$subsection_processing_transient = self::SUBSECTION_PROCESSING_TRANSIENT;
			$book_subsections                = get_transient( $book_subsections_transient );
			if ( ! $book_subsections ) {
				$book_subsections = array();
				if ( ! get_transient( $subsection_processing_transient ) ) {
					set_transient( $subsection_processing_transient, 1, 5 * MINUTE_IN_SECONDS );
					foreach ( $book_structure['front-matter'] as $section ) {
						$subsections = self::getSubsections( $section['ID'] );
						if ( $subsections ) {
							$book_subsections['front-matter'][ $section['ID'] ] = $subsections;
						}
					}
					foreach ( $book_structure['part'] as $key => $part ) {
						if ( ! empty( $part['chapters'] ) ) {
							foreach ( $part['chapters'] as $section ) {
								$subsections = self::getSubsections( $section['ID'] );
								if ( $subsections ) {
									$book_subsections['chapters'][ $section['ID'] ] = $subsections;
								}
							}
						}
					}
					foreach ( $book_structure['back-matter'] as $section ) {
						$subsections = self::getSubsections( $section['ID'] );
						if ( $subsections ) {
							$book_subsections['back-matter'][ $section['ID'] ] = $subsections;
						}
					}
					delete_transient( $subsection_processing_transient );
				}
			}
			set_transient( $book_subsections_transient, $book_subsections );
			return $book_subsections;
		}
		return array();
	}

	/**
	 * Returns an array of subsections in front matter, back matter, or chapters.
	 *
	 * @param $id
	 *
	 * @return array|false
	 */
	static function getSubsections( $id ) {
		$parent = get_post( $id );
		if ( empty( $parent ) ) {
			return false;
		}
		$has_heading_shortcode = has_shortcode( $parent->post_content, 'heading' );
		if ( stripos( $parent->post_content, '<h2' ) === false && $has_heading_shortcode === false ) {
			// No <h1> or [heading] shortcode, nothing to do
			return false;
		}

		if ( $has_heading_shortcode ) {
			// Only render heading shortcode into <h1> if we have to
			$content = \Pressbooks\Utility\do_shortcode_by_tags( $parent->post_content, array( 'heading' ) );
			$content = strip_shortcodes( $content );
		} else {
			$content = $parent->post_content;
		}
		$content = strip_tags( $content, '<h2>' );  // Strip everything except <h1> to speed up load time

		$type   = $parent->post_type;
		$output = array();
		$s      = 1;

		$doc      = new HtmlParser( true ); // Because we are not saving, use internal parser to speed up load time
		$dom      = $doc->loadHTML( $content );
		$sections = $dom->getElementsByTagName( 'h2' );
		foreach ( $sections as $section ) {
			/** @var $section \DOMElement */
			$output[ $type . '-' . $id . '-section-' . $s ] = wptexturize( $section->textContent );
			$s++;
		}

		if ( empty( $output ) ) {
			return false;
		}

		return $output;
	}

}
