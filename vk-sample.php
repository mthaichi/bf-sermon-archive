<?php
/**
 * Plugin Name:       Vk Sample
 * Description:       Example block written with ESNext standard and JSX support – build step required.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       vk-sample
 *
 * @package           create-block
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

require_once __DIR__ . '/lib/class-object.php';
require_once __DIR__ . '/lib/class-block.php';
require_once __DIR__ . '/lib/class-plugin.php';


require_once __DIR__ . '/inc/class-vk-sample-plugin.php';
require_once __DIR__ . '/inc/class-vk-base-block.php';
require_once __DIR__ . '/inc/class-vk-marquee-block.php';


$plugin = new VK_SamplePlugin(__DIR__);
$plugin->initialize();

