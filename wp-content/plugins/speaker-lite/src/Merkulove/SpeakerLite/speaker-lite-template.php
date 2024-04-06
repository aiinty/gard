<?php
/**
 * Template Name: Speaker Template
 * File: speaker-lite-template.php
 **/

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

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}

use Merkulove\SpeakerLite\Settings;

get_header();

?><!-- Speaker Content Start --><?php
if ( have_posts() ) {

    while ( have_posts() ) {

        the_post();

        /** Include title in audio version? */
        $options = Settings::get_instance()->options;
        if ( 'on' === $options['read_title'] ) {
            ?><h1><?php the_title(); ?></h1><break time="1s"></break><?php
        }

        the_content();

    }

}
?><!-- Speaker Content End --><?php

get_footer();
