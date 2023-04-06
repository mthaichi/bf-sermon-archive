<?php
/**
 * Plugin Name:       BF Favorite Patterns
 * Description:       BREADFISHで用意したパターンを読み込みます。
 * Requires at least: 6.1.1
 * Requires PHP:      7.4
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       bf-favorite-patterns
 *
 * @package           bf-favorite-patterns
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
/*
function create_block_vk_sample_block_init() {
	register_block_type( __DIR__ . '/build/base/' );
}
add_action( 'init', 'create_block_vk_sample_block_init' );

*/
include "vendor/autoload.php";
// lib/ の中はcomposer化してもいい。

// Define plugin path.
define( 'BFFP_PATH', plugin_dir_path( __FILE__ ) );

// Define plugin url.
define( 'BFFP_URL', plugin_dir_url( __FILE__ ) );

require_once __DIR__ . '/lib/trait-singleton.php';
require_once __DIR__ . '/lib/class-object.php';
require_once __DIR__ . '/lib/class-block.php';
require_once __DIR__ . '/lib/class-plugin.php';
require_once __DIR__ . '/lib/class-option-page.php';
require_once __DIR__ . '/lib/class-view.php';
require_once __DIR__ . '/lib/class-input.php';

require_once __DIR__ . '/inc/function.php';
require_once __DIR__ . '/inc/class-header-toolbar.php';
require_once __DIR__ . '/inc/class-plugin.php';
require_once __DIR__ . '/inc/class-sample-block.php';
require_once __DIR__ . '/inc/class-marquee-block.php';
require_once __DIR__ . '/inc/class-option-page.php';
require_once __DIR__ . '/inc/class-favorite-pattern-manager.php';

$plugin = BF_FavoritePatterns\Plugin::get_instance();
$plugin->initialize(__DIR__);

