<?php
/**
 * Missing Content ShortCode
 *
 * @version      1.0.0
 * @package      WordPress
 * @subpackage   MCN
 *
 * @author       Matchbox Design Group <info@matchboxdesigngroup.com>
 * @author       Dan Holloran          <dholloran@matchboxdesigngroup.com>
 *
 * @copyright    2014 - Present         Matchbox Design Group
 */

/*
Plugin Name:  Missing Content Notice
Description:  Adds a ShortCode for when there is missing content, useful for development purposes.
Plugin URI:   http://#
Author:       dholloran
Author URI:   http://danholloran.me
Version:      1.0.0
License:      GPL2
*/

/*
	Copyright (C) 2014  Matchbox Design Group info@matchboxdesigngroup.com

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // if()



/**
 * Missing Content Notice version number.
 *
 * @var  string
 */
define( 'MCN_VERSION', '1.0.0' );

/**
 * Missing Content Notice plugin URL without trailing slash (http://{plugins_url}/missing-content-notice).
 *
 * @var  string
 */
define( MCN_URL, plugins_url( '/missing-content-notice' ) );

/**
 * Missing Content Notice plugin path with trailing slash (/PATH/TO/PLUGIN/DIRECTORY/missing-content-notice/).
 *
 * @var  string
 */
define( 'MCN_PATH', plugin_dir_path( __FILE__ ) );

// Debugging
require_once 'includes/mcn-debug.php';


/**
 * Retrieves the transient key for the HTTP response cache.
 * Uses MD5 to create a transient key from the ShortCode attributes.
 *
 * <code>$transient = mcn_get_cached_http_response_transient_key( $shortcode_atts );</code>
 *
 * @see     https://codex.wordpress.org/Transients_API
 *
 * @since   1.0.0
 *
 * @param array   $shortcode_atts The ShortCodes attributes aka ShortCode options.
 *
 * @return  return                    The transient key.
 */
function mcn_get_cached_http_response_transient_key( $shortcode_atts ) {
	$shortcode_atts = implode( '', $shortcode_atts );
	$transient      = md5( $shortcode_atts );

	return "_{$transient}";
} // mcn_get_cached_http_response_transient_key()



/**
 * Caches the HTTP response content.
 * Will use mcn_cache_http_response_multisite() if it is a Multisite installation.
 *
 * <code>mcn_cache_http_response( $response, $shortcode_atts );</code>
 *
 * @see     https://codex.wordpress.org/Function_Reference/set_transient
 *
 * @uses    mcn_get_cached_http_response_transient_key()
 *
 * @since   1.0.0
 *
 * @param mixed   $response       The response to cache from the HTTP request.
 * @param array   $shortcode_atts The ShortCodes attributes aka ShortCode options.
 *
 * @return  void
 */
function mcn_cache_http_response( $response, $shortcode_atts ) {
	if ( is_multisite() ) {
		return mcn_cache_http_response_multisite( $reponse, $shortcode_atts );
	} // if()

	$transient = mcn_get_cached_http_response_transient_key( $shortcode_atts );

	extract( $shortcode_atts );
	set_transient( $transient, $response, $shortcode_atts['cache_duration'] );

	return;
} // mcn_cache_http_response()



/**
 * Caches the HTTP response content, used on WordPress MultiSite installs.
 *
 * <code>mcn_cache_http_response_multisite( $response, $shortcode_atts );</code>
 *
 * @see     https://codex.wordpress.org/Function_Reference/set_site_transient
 *
 * @uses    mcn_get_cached_http_response_transient_key()
 *
 * @since   1.0.0
 *
 * @param mixed   $response       The response to cache from the HTTP request.
 * @param array   $shortcode_atts The ShortCodes attributes aka ShortCode options.
 *
 * @return  void
 */
function mcn_cache_http_response_multisite( $response, $shortcode_atts ) {
	$transient = mcn_get_cached_http_response_transient_key( $shortcode_atts );

	extract( $shortcode_atts );
	set_site_transient( $transient, $response, $shortcode_atts['cache_duration'] );

	return;
} // mcn_cache_http_response_multisite()



/**
 * Retrieves the cached HTTP response if it exists.
 * Will use mcn_get_cached_http_response_multisite() if it is a Multisite installation.
 *
 * <code>$cache = mcn_get_cached_http_response( $shortcode_atts );</code>
 *
 * @see     https://codex.wordpress.org/Function_Reference/get_transient
 *
 * @uses    mcn_get_cached_http_response_transient_key()
 *
 * @since   1.0.0
 *
 * @param array   $shortcode_atts The ShortCodes attributes aka ShortCode options.
 *
 * @return  mixed                  The cached content if it exists or false if it does not.
 */
function mcn_get_cached_http_response( $shortcode_atts ) {
	if ( is_multisite() ) {
		return mcn_get_cached_http_response_multisite( $shortcode_atts );
	} // if()

	$transient     = mcn_get_cached_http_response_transient_key( $shortcode_atts );
	$get_transient = get_transient( $transient );

	if ( $get_transient !== false ) {
		return $get_transient;
	} // if()

	return false;
} // mcn_get_cached_http_response()



/**
 * Retrieves the cached HTTP response if it exists, used on WordPress MultiSite installs.
 *
 * <code>$cache = mcn_get_cached_http_response_multisite( $shortcode_atts );</code>
 *
 * @see     https://codex.wordpress.org/Function_Reference/get_site_transient
 *
 * @uses    mcn_get_cached_http_response_transient_key()
 *
 * @since   1.0.0
 *
 * @param array   $shortcode_atts The ShortCodes attributes aka ShortCode options.
 *
 * @return  mixed                    The cached content if it exists or false if it does not.
 */
function mcn_get_cached_http_response_multisite( $shortcode_atts ) {
	$transient = mcn_get_cached_http_response_transient_key( $shortcode_atts );

	$get_site_transient = get_site_transient( $transient );
	if ( $get_site_transient !== false ) {
		return $get_site_transient;
	} // if()

	return false;
} // mcn_get_cached_http_response_multisite()



/**
 * If selected API fails this will be used as a fall back placeholder content.
 *
 * <code>$content = mcn_fallback_ipsum( $paragraph_count );</code>
 *
 * @since   1.0.0
 *
 * @param boolean $html Should the text be wrapped in paragraph tags or divided by newlines.
 *
 * @return  string          The fall back ipsum.
 */
function mcn_fallback_ipsum( $html = true ) {
	$fallback_ipsum = '';
	$content        = array();

	$content[] = 'Aliquam vel dolor sit amet tortor ullamcorper fermentum sit amet dictum tellus. Quisque in elit velit. Nunc dignissim neque vel leo volutpat, eget rutrum orci ultricies. Aliquam erat volutpat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque adipiscing ligula nec porttitor pulvinar. Praesent ac libero quis velit porttitor varius a non magna. Curabitur at euismod orci. Ut pulvinar, ligula iaculis tristique tincidunt, dui dolor consectetur felis, ac faucibus tortor velit eget mi. Nulla interdum consectetur leo nec dictum. Nulla interdum nulla tortor, ac tempus tortor malesuada sed. Phasellus dapibus porta magna sit amet egestas. Vivamus sit amet ante ut diam mattis tempus quis vitae purus. Sed feugiat purus libero, nec tristique ipsum volutpat ut. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;';
	$content[] = 'Curabitur diam orci, molestie eget massa a, rhoncus blandit neque. Sed gravida dolor non fermentum posuere. Suspendisse volutpat lacus lectus, nec laoreet massa pretium sed. Integer a metus felis. Etiam id congue eros, sit amet venenatis magna. Aenean bibendum dictum urna, et ullamcorper metus. Ut at elit nec lacus sagittis posuere. Sed nec ultrices tellus. Nunc sed nibh quis lorem condimentum luctus et non orci. Nullam in tortor vitae turpis sollicitudin elementum. Pellentesque tincidunt condimentum nisi, nec fringilla lectus condimentum sit amet. Nam semper, est vitae consequat tincidunt, est libero convallis elit, a ultricies sapien sem sit amet nisi. Suspendisse egestas urna et pellentesque malesuada. Suspendisse eget scelerisque augue.';
	$content[] = 'Vestibulum eu adipiscing massa. Curabitur nec velit purus. Donec et semper lacus. Nulla facilisi. Curabitur tempus viverra nisi sed tristique. Aliquam erat volutpat. Vestibulum at tincidunt ante, id semper odio. Nulla quis diam consequat, commodo dui ac, commodo nibh. Ut hendrerit mi nec lorem tincidunt euismod. Nulla porta elementum tortor non vulputate. Aliquam aliquet tellus id dui convallis dignissim. Fusce eleifend, odio ac iaculis iaculis, turpis nibh interdum felis, vehicula volutpat lorem arcu id velit. Donec pulvinar libero ut sapien euismod, sit amet pulvinar risus dignissim.';

	if ( $html ) {
		foreach ( $content as $key => $value ) {
			$content[$key] = "<p>{$value}</p>";
		} // foreach()

		return implode( '', $content );
	} // if()

	return implode( "\n", $content );
} // mcn_fallback_ipsum()



/**
 * Retrieve Loreum Ipsum (API Response:HTML/Plain Text)
 *
 * <code>$content = mcn_get_lipsum( $shortcode_atts, $paragraph_count );</code>
 *
 * @see     http://loripsum.net/
 *
 * @uses    mcn_get_cached_http_response()
 * @uses    mcn_cache_http_response()
 *
 * @since   1.0.0
 *
 * @param array   $shortcode_atts  The ShortCodes attributes aka ShortCode options.
 * @param integer $paragraph_count The count of paragraphs to retrieve.
 * @param boolean $html            Should the text be wrapped in paragraph tags or divided by newlines.
 *
 * @return  string                     The lipsum content.
 */
function mcn_get_lipsum( $shortcode_atts, $paragraph_count = 3, $html = true ) {
	$cache = mcn_get_cached_http_response( $shortcode_atts );
	if ( $cache !== false ) {
		return $cache;
	} // if()

	$paragraph_count  = "{$paragraph_count}/";
	$paragraph_length = 'medium/';
	$plaintext        = ( $html ) ?  '' : 'plaintext';
	$lipsum_api       = "http://loripsum.net/api/{$paragraph_count}{$paragraph_length}{$plaintext}";
	$lipsum           = wp_remote_get( $lipsum_api );

	if ( is_wp_error( $lipsum ) ) {
		return '';
	} else {
		mcn_cache_http_response( $lipsum['body'], $shortcode_atts );
		return $lipsum['body'];
	} // if/else()
} // mcn_get_lipsum()



/**
 * Retrieves Bacon Ipsum (API Response:JSON).
 *
 * <code>$content = mcn_get_bacon_ipsum( $shortcode_atts, $paragraph_count );</code>
 *
 * @see     http://baconipsum.com/api/
 *
 * @uses    mcn_get_cached_http_response()
 * @uses    mcn_cache_http_response()
 *
 * @since   1.0.0
 *
 * @param array   $shortcode_atts  The ShortCodes attributes aka ShortCode options.
 * @param integer $paragraph_count The count of paragraphs to retrieve.
 * @param boolean $html            Should the text be wrapped in paragraph tags or divided by newlines.
 *
 * @return  string                     The bacon ipsum content.
 */
function mcn_get_bacon_ipsum( $shortcode_atts, $paragraph_count = 3, $html = true ) {
	$cache = mcn_get_cached_http_response( $shortcode_atts );
	if ( $cache !== false ) {
		return $cache;
	} // if()

	$types            = array( 'meat-and-filler', 'all-meat', );
	$type_key         = array_rand( $types );
	$type             = $types[$type_key];
	$start_with_lorem = rand( 0, 1 ); // 1|0
	$bacon_ipsum_api  = "https://baconipsum.com/api/?type={$type}&paras={$paragraph_count}&start-with-lorem={$start_with_lorem}";
	$bacon_ipsum      = wp_remote_get( $bacon_ipsum_api );

	if ( is_wp_error( $bacon_ipsum ) ) {
		return '';
	} else {
		$bacon_ipsum = json_decode( $bacon_ipsum['body'] );
		$bacon_ipsum = implode( "\n\n", $bacon_ipsum );
		$bacon_ipsum = ( $html ) ? wpautop( $bacon_ipsum, false ) : $bacon_ipsum;

		mcn_cache_http_response( $bacon_ipsum, $shortcode_atts );

		return $bacon_ipsum;
	} // if/else()
} // mcn_get_bacon_ipsum()



/**
 * Retrieves Hipster Ipsum (API Response:JSON).
 *
 * <code>$content = mcn_get_hipster_ipsum( $shortcode_atts, $paragraph_count );</code>
 *
 * @see     http://hipsterjesus.com/
 *
 * @uses    mcn_get_cached_http_response()
 * @uses    mcn_cache_http_response()
 *
 * @since   1.0.0
 *
 * @param array   $shortcode_atts  The ShortCodes attributes aka ShortCode options.
 * @param integer $paragraph_count The count of paragraphs to retrieve.
 * @param boolean $html            Should the text be wrapped in paragraph tags or divided by newlines.
 *
 * @return  string                     The bacon ipsum content.
 */
function mcn_get_hipster_ipsum( $shortcode_atts, $paragraph_count = 3, $html = true ) {
	$cache = mcn_get_cached_http_response( $shortcode_atts );
	if ( $cache !== false ) {
		return $cache;
	} // if()

	$types             = array( 'hipster-latin', 'hipster-centric', );
	$type_key          = array_rand( $types );
	$type              = $types[$type_key];
	$return_html       = ( $html ) ? 'true' : 'false';
	$hipster_ipsum_api = "http://hipsterjesus.com/api/?paras={$paragraph_count}&type={$type}&html={$return_html}";
	$hipster_ipsum     = wp_remote_get( $hipster_ipsum_api );

	if ( is_wp_error( $hipster_ipsum ) ) {
		return '';
	} else {
		$hipster_ipsum = json_decode( $hipster_ipsum['body'] );
		$hipster_ipsum = $hipster_ipsum->text;

		mcn_cache_http_response( $hipster_ipsum, $shortcode_atts );

		return $hipster_ipsum;
	} // if/else()
} // mcn_get_bacon_ipsum()



/**
 * Blokk font placeholder font.
 *
 * <code>$content = mcn_blokk_font( $shortcode_atts, $paragraph_count );</code>
 *
 * @see     http://blokkfont.com/
 *
 * @uses    mcn_get_lipsum()
 *
 * @since   1.0.0
 *
 * @param array   $shortcode_atts  The ShortCodes attributes aka ShortCode options.
 * @param integer $paragraph_count The count of paragraphs to retrieve.
 *
 * @return  string                     The Blokk font content.
 */
function mcn_blokk_font( $shortcode_atts, $paragraph_count = 3 ) {
	$lipsum     = mcn_get_lipsum( $shortcode_atts, $paragraph_count, false );
	$blokk_font = '';

	for ( $i = 0; $i < $paragraph_count; $i++ ) {
		$blokk_font .= "<p class='mc-blokk'>{$lipsum}</p>";
	} // for()

	return $blokk_font;
} // mcn_blokk_font()



/**
 * Placeholder image.
 *
 * <code>$placeholder_image = mcn_placeholder_image( $width, $height );</code>
 *
 * @see     http://placehold.it
 *
 * @since   1.0.0
 *
 * @param integer $width  Image width.
 * @param integer $height Image height.
 *
 * @return  string            Missing image HTML.
 */
function mcn_placeholder_image( $width = 150, $height = 150 ) {
	$image_html = "<img src='http://placehold.it/{$width}x{$height}' class='missing-content' width='{$width}' height='{$height}'>";

	return $image_html;
} // mcn_placeholder_image()



/**
 * Retrieves the correct placeholder content.
 *
 * @since   1.0.0
 *
 * @param array   $shortcode_atts The ShortCodes attributes aka ShortCode options.
 *
 * <code>$placeholder_content = mcn_get_placeholder_content( $atts );</code>
 *
 * @uses mcn_get_hipster_ipsum()
 * @uses mcn_get_bacon_ipsum()
 * @uses mcn_blokk_font()
 * @uses mcn_placeholder_image()
 * @uses mcn_get_lipsum()
 *
 * @return  string                   The selected ipsum content.
 */
function mcn_get_placeholder_content( $shortcode_atts ) {
	extract( $shortcode_atts );

	$content = '';
	switch ( $ipsum_type ) {
		case 'hipster':
			$content = mcn_get_hipster_ipsum( $shortcode_atts, $paragraph_count );
			break;

		case 'bacon':
			$content = mcn_get_bacon_ipsum( $shortcode_atts, $paragraph_count );
			break;

		case 'blokk':
			$content = mcn_blokk_font( $shortcode_atts, $paragraph_count );
			break;

		case 'image':
			$content = mcn_placeholder_image( $width, $height );
			break;

		default:
			$content = mcn_get_lipsum( $shortcode_atts, $paragraph_count );
			break;
	} // switch()

	if ( is_null( $content ) or ! $content or $content == '' ) {
		$content = mcn_fallback_ipsum( $paragraph_count );
	} // if()

	return $content;
} // mcn_get_placeholder_content()



/**
 * Adds Missing Content ShortCode scripts and styles.
 *
 * @since   1.0.0
 *
 * @return  void
 */
function mcn_enqueue_scripts_and_styles() {
	wp_enqueue_style( 'mcn_main_css', MCN_URL . '/assets/css/mcs-plugin.min.css', array(), MCN_VERSION, 'screen' );
} // mcn_enqueue_scripts_and_styles()
add_action( 'wp_head', 'mcn_enqueue_scripts_and_styles' );



/**
 * Adds a missing content ShortCode.
 *
 * <code>[missing-content ipsum_type="lipsum|hipster|bacon|blokk|image" paragraph_count="3" width="150" height="150" cache_duration="10800"]</code>
 *
 * @uses    mcn_get_placeholder_content()
 *
 * @since   1.0.0
 *
 * @param array   $atts The ShortCodes attributes aka ShortCode options.
 *
 * @return  string          The missing content HTML.
 */
function mcn_missing_content_shortcode( $atts ) {
	$defaults = array(
		'ipsum_type'      => 'lipsum', // lipsum|hipster|bacon|blokk
		'paragraph_count' => 3,
		'width'           => 150,
		'height'          => 150,
		'cache_duration'  => ( 3 * HOUR_IN_SECONDS ), // {time in seconds}|always
	);
	$atts = shortcode_atts( $defaults, $atts );

	// Allows for the response to "always" be cached, if missing content
	// has not been added in a year you have a larger problem than the cache...
	$atts['cache_duration'] = ( $atts['cache_duration'] == 'always' ) ? YEAR_IN_SECONDS : intval( $atts['cache_duration'] );

	extract( $atts );

	if ( $ipsum_type == 'image' ) {
		return wp_kses( mcn_get_placeholder_content( $atts ), 'post' );
	} // if()

	$html  = '';
	$html .= '<div class="missing-content-notice-shortcode">';
	$html .= wp_kses( mcn_get_placeholder_content( $atts ), 'post' );
	$html .= '</div>';
	return $html;
} // mcn_missing_content_shortcode()
add_shortcode( 'missing-content', 'mcn_missing_content_shortcode' );
