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
    <div class="video-overlay-ads-optionform-holder">
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
    <div class="video-overlay-ads-righttip-holder">
        <h2>Need Help?</h2>
        <p>We are software developers. Loving to develop websites, mobile apps, and mobile games. Do you have a customized inquiry? Please send us an email <a href="mailto:wordpress@salinus.com" target="_blank">wordpress@salinus.com</a>.</p>
        <h3>Liked our plugin?</h3>
        <p>You can support us, so we can keep updating and adding new features. We are always thankful for your generous tips.</p>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_xclick">
            <input type="hidden" name="business" value="payment@salinus.com">
            <input type="hidden" name="lc" value="US">
            <input type="hidden" name="item_name" value="Video Overlay Ads Tips">
            <input type="hidden" name="button_subtype" value="services">
            <input type="hidden" name="no_note" value="0">
            <input type="hidden" name="currency_code" value="USD">
            <input type="hidden" name="bn" value="PP-BuyNowBF:btn_paynow_LG.gif:NonHostedGuest">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>
    </div>
<style>
.video-overlay-ads-optionform-holder{
    display: block;
    float: left;
    width: 70%;
    margin: 0;
    padding: 10px;
}
.video-overlay-ads-righttip-holder{
    display: block;
    float: left;
    width: 25%;
    background: #dedede;
    border: 1px solid #fff;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    padding: 10px;
    margin: 0;
    margin-top: 30px;
}
@media screen and (max-width: 1080px) {
    .video-overlay-ads-optionform-holder{
        width: 100%;
    }
    .video-overlay-ads-righttip-holder{
        width: 100%;
    }
}
</style>
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