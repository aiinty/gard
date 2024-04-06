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

/** Register plugin custom autoloader. */
/** @noinspection PhpUnhandledExceptionInspection */
spl_autoload_register( static function ($class ) {

	$namespace = 'Merkulove\\';

	/** Bail if the class is not in our namespace. */
	if ( 0 !== strpos( $class, $namespace ) ) {
		return;
	}

	/** Build the filename. */
	$file = realpath( __DIR__ );
	$file .= DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

	/** If the file exists for the class name, load it. */
	if ( file_exists( $file ) ) {

		/** @noinspection PhpIncludeInspection */
        include_once( $file );

	}

} );
