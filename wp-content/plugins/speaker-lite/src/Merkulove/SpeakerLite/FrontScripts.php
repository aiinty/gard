<?php
/**
 * {{plugin_description}}
 * Exclusively on Envato Market: {{plugin_uri}}
 *
 * @encoding        UTF-8
 * @version         1.1.7
 * @copyright       Merkulove
 * @license         (ISC OR GPL-3.0)
 * @contributors    Alexander Khmelnitskiy, Dmytro Merkulov
 * @support         help@merkulov.design
 **/

namespace Merkulove\SpeakerLite;

use Merkulove\SpeakerLite;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * SINGLETON: Class adds admin styles.
 *
 * @since 1.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class FrontScripts {

	/**
	 * The one true FrontScripts.
	 *
	 * @var FrontScripts
	 * @since 1.0.0
	 **/
	private static $instance;

	/**
	 * Sets up a new FrontScripts instance.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	private function __construct() {

		/** Add plugin scripts. */
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

	}

	/**
	 * Add plugin scripts.
	 *
	 * @return void
	 * @since   1.0.0
	 **/
	public function enqueue_scripts() {

		/** Remove WP mediaElement if set Default Browser Player. */
		if ( 'speaker-lite-browser-default' === Settings::get_instance()->options['style'] ) { return; }

		wp_enqueue_script( 'jquery' );

	}

	/**
	 * Main FrontScripts Instance.
	 *
	 * Insures that only one instance of FrontScripts exists in memory at any one time.
	 *
	 * @static
	 * @return FrontScripts
	 * @since 1.0.0
	 **/
	public static function get_instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof FrontScripts ) ) {

			self::$instance = new FrontScripts;

		}

		return self::$instance;

	}

} // End Class FrontScripts.
