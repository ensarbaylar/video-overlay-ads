<?php
/*
Plugin Name: WP Video Overlay Ads
Version: 1.0.0
Plugin URI: http://salinus.com/
Author: Salinus
Author URI: http://salinus.com/
Description: Add overlay advertisement area over youtube video embeds before video starts
*/

// Import Javascript
add_action( 'wp_enqueue_scripts', 'video_overlay_script' );
function video_overlay_script() {
	wp_enqueue_script( 'bootstrap-min-js', plugin_dir_url( __FILE__ ) .  '/js/main.js', array( 'jquery' ) );
}


?>