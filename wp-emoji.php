<?php
/**
 * Plugin Name:         Wp Emoji
 * Plugin URI:          https://github.com/RatulHasan/wp-emoji
 * Description:         A minor plugin that can fix your WordPress emoji problems.
 * Version:             1.0.0
 * Requires PHP:        7.4
 * Requires at least:   6.0.2
 * Author:              Ratul Hasan
 * Author URI:          https://ratulhasan.com
 * License:             GPL-2.0-or-later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:         wp-emoji
 * Domain Path:         /languages
 *
 * @package WordPress
 */

// To prevent direct access, if not define WordPress ABSOLUTE PATH then exit.
if ( ! defined( 'ABSPATH' ) ) {
    exit();
}

/**
 * Main class
 */
final class WpEmoji{

    /**
     * WpEmoji construct
     */
    private function __construct() {
        // Disable emojis.
        add_action( 'init', [ $this, 'disable_emojis' ] );
    }

    /**
     * Initializes the Workplace() class.
     *
     * Checks for an existing Workplace() instance
     * and if it doesn't find one, creates it.
     *
     * @since 1.0.0
     *
     * @return WpEmoji|bool
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new WpEmoji();
        }

        return $instance;
    }

    /**
     * Remove all hooks to disable emoji which WordPress treats like an image.
     *
     * @return void
     */
    public function disable_emojis() {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        add_filter( 'wp_resource_hints', [ $this, 'disable_emojis_remove_dns_prefetch' ], 10, 2 );
    }

    /**
     * Remove Emoji in WordPress automatically CDN hostname from DNS prefetching hints.
     *
     * @param array  $urls URLs to print for resource hints.
     * @param string $relation_type The relation type the URLs are printed for.
     *
     * @return array Difference between the two arrays.
     */
    public function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
        if ( 'dns-prefetch' === $relation_type ) {
            /** This filter is documented in wp-includes/formatting.php */
            $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );
            $urls          = array_diff( $urls, array( $emoji_svg_url ) );
        }

        return $urls;
    }

}

/**
 * Main entry point for WpEmoji plugin.
 *
 * @return bool|\WpEmoji
 */
function hit_start(){
    return WpEmoji::init();
}

// Hit start the plugin.
hit_start();
