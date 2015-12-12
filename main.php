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
	wp_enqueue_style( 'video-overlay-main-css', plugin_dir_url( __FILE__ ) .  '/css/main.css' );
	wp_enqueue_script( 'video_overlay_localized', plugin_dir_url( __FILE__ ) .  '/js/main.js', array( 'jquery' ) );

	wp_localize_script('video_overlay_localized', 'VideoOverlayAds', array( 'overlay_inner_html' => get_option('video-overlay-inner-html'), 'overlay_close_button' => get_option('video-overlay-display-close-btn') ));

	// Enqueued script with localized data.
	wp_enqueue_script( 'video_overlay_localized' );
}

// Create Custom Plugin Settings Menu
add_action('admin_menu', 'video_overlay_create_menu');
function video_overlay_create_menu() {
	//create new top-level menu
	add_options_page('Video Overlay Ads Settings', 'Video Overlay Ads Settings', 'administrator', __FILE__, 'video_overlay_settings_page');
	//call register settings function
	add_action( 'admin_init', 'video_overlay_register_mysettings' );
}
// Plugin Setting Menu
function video_overlay_settings_page() {
?>
<div class="wrap">
<h2>Video Overlay Ads Settings</h2>
<form method="post" action="options.php">
    <?php settings_fields( 'video-overlay-settings' ); ?>
    <?php settings_fields( 'video-overlay-settings' ); ?>
    <table class="form-table">
        <tr valign="top">
            <th scope="row">Html input to render inside the overlay ads.</th>
            <td><textarea name="video-overlay-inner-html" rows="8" style="width:100%; display:block"><?php echo get_option('video-overlay-inner-html'); ?></textarea></td>
        </tr>
        <tr valign="top">
            <th scope="row">Display close button</th>
            <td><input type="checkbox" name="video-overlay-display-close-btn" <?php if ( get_option('video-overlay-display-close-btn') == 1 || get_option('video-overlay-display-close-btn') == 'on' ) echo 'checked="checked"'; ?> /></td>
        </tr>
    </table>
    <?php submit_button(); ?>
</form>
</div>
<?php 
}

// Register settings
function video_overlay_register_mysettings() {
	//register our settings
	register_setting( 'video-overlay-settings', 'video-overlay-inner-html' );
	register_setting( 'video-overlay-settings', 'video-overlay-display-close-btn' );
}

?>