<?php 
/**
* Plugin Name: Ominis Shortcodes
* Description: Plugin to interpret shortcodes and create Bootstrap structures.
* Version: 2.0.2
* Author: Onaweb
* Author URI: http://onaweb.cat
* License:     GPLv2 or later
* License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
* Domain Path: /languages
*
* This program is free software; you can redistribute it and/or modify it under the terms of the GNU
* General Public License version 2, as published by the Free Software Foundation. You may NOT assume
* that you can use any other version of the GPL.
*
* This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
* even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
**/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Add menu item
add_action('admin_menu', 'ominis_shortcodes_menu');

// Config menu item 
function ominis_shortcodes_menu(){
    add_menu_page(
        __('Ominis Shortcodes Instructions','ominis-shortcodes'),
        __('O Shortcodes','ominis-shortcodes'),
        'manage_options',
        'ominis-shortcodes',
        'ominis_shortcodes_instrucciones',
        'dashicons-hammer',
        75
    );
}

// Content of welcome page with instructions
function ominis_shortcodes_instrucciones() {
    ?>
    <div class="wrap">
        <h2><?php esc_html_e('Ominis Shortcodes: Instructions','ominis-shortcodes');?> <small>2.0.2</small></h2>

        <p><?php echo sprintf( __('You have three [shortcodes] available to generate the Bootstrap 5 %1$s component:','ominis-shortcodes'), '<em>card</em>' );?></p>
        <dl>
            <dt style="font-weight:bold;">[panel]...[/panel]</dt>
            <dd><?php echo sprintf( __('This shortcode opens and closes the %1$s component.','ominis-shortcodes'), '<em>card</em>' );?></dd>
            
            <dt style="font-weight:bold;">[panel_texto]...[/panel_texto]</dt>
            <dd><?php esc_html_e('Inside [panel], this shortcode opens and closes the text area.','ominis-shortcodes');?></dd>
            
            <dt style="font-weight:bold;">[panel_img]...[/panel_img]</dt>
            <dd><?php esc_html_e('Inside [panel], this shortcode opens and closes the area for images.','ominis-shortcodes');?></dd>
        </dl>
    </div>
    <?php   
}

/**
 * SHORTCODE OPTIONS.
 */

// [panel]
function panel_func( $atts, $content = null ) {
    // Eliminamos <p>, <br> automáticos alrededor de shortcodes internos
    $inner = shortcode_unautop( do_shortcode( $content ) );
	$inner = str_replace("<p></p>","",$inner);
    $texto = '<dl class="card">' . $inner . '</dl>';
    return $texto;
}
add_shortcode( 'panel', 'panel_func' );

// [panel_texto]
function panel_texto_func( $atts, $content = null ) {
    $inner = shortcode_unautop( do_shortcode( $content ) );
 	$inner = str_replace("<p></p>","",$inner);
    $texto = '<dt class="card-body text-justify fw-normal">' . $inner . '</dt>';
    return $texto;
}
add_shortcode( 'panel_texto', 'panel_texto_func' );

// [panel_img]
function panel_img_func( $atts, $content = null ) {
    $inner = shortcode_unautop( do_shortcode( $content ) );
	$inner = str_replace("<p></p>","",$inner);
    $texto = '<dd class="card-footer d-flex flex-wrap flex-xl-nowrap mb-0">' . $inner . '</dd>';
    return $texto;
}
add_shortcode( 'panel_img', 'panel_img_func' );

/**
 * Tell WordPress that these shortcodes should not receive autop/texturize.
 */

// Avoid texturing (typographic quotation marks, etc.) within shortcodes
add_filter( 'no_texturize_shortcodes', function( $shortcodes ) {
    $shortcodes[] = 'panel';
    $shortcodes[] = 'panel_texto';
    $shortcodes[] = 'panel_img';
    return $shortcodes;
} );

// Specify which shortcodes should be cleaned by shortcode_unautop
add_filter( 'shortcode_unautop', function( $shortcodes ) {
    $shortcodes[] = 'panel';
    $shortcodes[] = 'panel_texto';
    $shortcodes[] = 'panel_img';
    return $shortcodes;
} );