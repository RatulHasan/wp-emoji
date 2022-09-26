<?php
/**
 * Plugin Name:         Wp Emoji
 * Plugin URI:          https://github.com/RatulHasan/wp-emoji
 * Description:         A minor plugin that can fix your WordPress emoji problems.
 * Version:             1.0.0
 * Requires PHP:        7.4
 * Requires at least:   6.0.2
 * Author:              Ratul Hasan
 * Author URI:          https://ratuljh.wordpress.com/
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

final class WpEmoji{
    public function __construct() {

    }

}

function hit_start(){
    new WpEmoji();
}

hit_start();
