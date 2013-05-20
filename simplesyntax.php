<?php
/*
Plugin Name: Simple Syntax
Description: No hassle way to highlight your <code>&lt;pre&gt;</code> and <code>&lt;code&gt;</code> tags using Prettify.js
Version: 1.0
License: GPL v3
Author: Mark Hesketh
Author URI: http://www.markhesketh.co.uk
*/

/*
* Load prettify.js
*/
function ss_load_js() {
    wp_deregister_script( 'prettify' );
    wp_register_script( 'prettify', WP_PLUGIN_URL . '/' . basename(dirname(__FILE__)).  '/assets/prettify.js', NULL, false, true);
    wp_enqueue_script( 'prettify' );
}
add_action('wp_enqueue_scripts', 'ss_load_js');

/*
* Load simplesyntax.js
*/
function ss_load_simplesyntax() {
    wp_deregister_script( 'simplesyntax' );
    wp_register_script( 'simplesyntax', WP_PLUGIN_URL . '/' . basename(dirname(__FILE__)) . '/assets/simplesyntax.js', array('jquery'), false, true);
    wp_enqueue_script( 'simplesyntax' );
}
add_action('wp_enqueue_scripts', 'ss_load_simplesyntax');

/*
* Load prettify.css
*/
function ss_load_css() {
	wp_deregister_style( 'prettify' );
	wp_register_style('prettify', WP_PLUGIN_URL . '/' . basename(dirname(__FILE__)) . '/assets/prettify.css');
	wp_enqueue_style('prettify');
}
add_action('wp_enqueue_scripts', 'ss_load_css');

/**
 * Add 'prettyprint' class to <code> and <pre> tags
 */
function ss_add_prettyprint_class( $content ) {

    // Add <code> tags within the <pre>
    $content = str_replace('<pre>', '<pre><code>', $content);
    $content = str_replace('</pre>', '</code></pre>', $content);

    $content = str_replace('<code><code>', '<code>', $content);
    $content = str_replace('</code></code>', '</code>', $content);

    return $content;
}
add_filter( 'the_content', 'ss_add_prettyprint_class' );
