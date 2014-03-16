<?php
/**
 * Missing Content Notice debugging.
 *
 * @version      1.0.0
 *
 * @package      WordPress
 * @subpackage   MCN_DEBUG
 *
 * @author       Matchbox Design Group <info@matchboxdesigngroup.com>
 * @author       Dan Holloran          <dholloran@matchboxdesigngroup.com>
 *
 * @copyright    2014 - Present         Matchbox Design Group
 */


/**
 * Checks if the current host is localhost, a VirtualBox VM, or sitename.dev vHost.
 *
 * <code>
 * if ( mcn_debug_is_localhost() ) {
 * 	do_something_related_to_localhost();
 * } // if()
 * </code>
 *
 * @since  1.0.0
 *
 * @return boolean If the current host is localhost.
 */
function mcn_debug_is_localhost() {
	$localhost = array(
		'localhost',
		'127.0.0.1',
		'10.0.2.2',
	);
	$host      = ( isset( $_SERVER['HTTP_HOST'] ) ) ? $_SERVER['HTTP_HOST'] : '';
	$is_vhost  = strpos( $host, '.dev' );

	if ( in_array( $host, $localhost ) or $is_vhost ) {
		return true;
	} // if()

	return false;
} // mcn_debug_is_localhost()



if ( ! function_exists( 'pp' ) ) {
	/**
	 * Pretty Print Debug Function
	 *
	 * <code>pp( $something_to_pretty_print );</code>
	 *
	 * @uses   mcn_debug_is_localhost()
	 *
	 * @since  1.0.0
	 *
	 * @param mixed   $value Any value to pretty print.
	 *
	 * @return Void
	 */
	function pp( $value ) {
		global $mdg_generic;

		if ( ! mcn_debug_is_localhost() ) {
			return;
		} // if()

		echo '<pre>';
		if ( $value ) {
			print_r( $value );
		} else {
			var_dump( $value );
		} // if/else()
		echo '</pre>';
	} // pp()
} // if()