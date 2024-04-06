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

( function ( $ ) {

    "use strict";

    jQuery( document ).ready( function () {

        jQuery( '.mdp-rating-stars' ).find( 'a' ).on( 'hover', function() {
            jQuery( this ).nextAll( 'a' ).children( 'span' ).removeClass( 'dashicons-star-filled' ).addClass( 'dashicons-star-empty' );
            jQuery( this ).prevAll( 'a' ).children( 'span' ).removeClass( 'dashicons-star-empty' ).addClass( 'dashicons-star-filled' );
            jQuery( this ).children( 'span' ).removeClass( 'dashicons-star-empty' ).addClass( 'dashicons-star-filled' );
        } );

    } );

} ( jQuery ) );
