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
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * Class to implement Speaker WPBakery Element.
 *
 * @since 1.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class WPBakery {

	/**
	 * The one true SpeakerWPBakery.
	 *
	 * @var Helper
	 * @since 1.0.0
	 **/
	private static $instance;

	/**
	 * Sets up a new SpeakerWPBakery instance.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function __construct() {

		/** Check if WPBakery VC is installed */
		if ( ! defined( 'WPB_VC_VERSION' ) ) { return; }

		/** Load WPBakery VC elements. */
		add_action( 'vc_before_init', [$this, 'load_elements'] );

		/** Load admin CSS. */
		add_action( 'admin_enqueue_scripts', [$this, 'admin_styles'] );

	}

	/**
	 * Add CSS for admin area.
	 *
	 * @return void
	 * @since 1.0.0
	 **/
	public function admin_styles() {

		/** Speaker Settings Page. */
		wp_enqueue_style( 'mdp-speaker-lite-vce-admin', SpeakerLite::$url . 'css/wpbakery-admin' . SpeakerLite::$suffix . '.css', [], SpeakerLite::$version );

	}

	/**
	 * Load all available VC Elements.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function load_elements() {

		/** Load VC Elements, file must ends by ".WPBakery.php" */
		$path = SpeakerLite::$path . 'src/Merkulove/SpeakerLite/WPBakery/elements/';
		foreach ( new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $path ) ) as $filename ) {

			if ( substr( $filename, -13 ) === ".wpbakery.php" ) {

				/** @noinspection PhpIncludeInspection */
				require_once $filename;

			}

		}

	}

	/**
	 * Main SpeakerWPBakery Instance.
	 *
	 * Insures that only one instance of SpeakerWPBakery exists in memory at any one time.
	 *
	 * @static
	 * @since 1.0.0
     *
     * @return Helper
	 **/
	public static function get_instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {

			self::$instance = new self;

		}

		return self::$instance;

	}

} // End Class SpeakerWPBakery.
