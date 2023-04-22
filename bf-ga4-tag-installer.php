<?php
/**
 * Plugin Name:       BF GA4 Tag Installer
 * Description:       The GA4 Tag Output Plugin outputs the Google Analytics 4 tracking tag for your website. Simply install and activate the plugin to start tracking your website's analytics data with GA4.
 * Requires at least: 6.1.1
 * Requires PHP:      7.4
 * Version:           0.0.2
 * Author:            BREADFISH
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       bf-plugin-base
 *
 * @package           bf-plugin-base
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

require_once 'autoload.php';


$plugin = BF_Ga4TagInstaller\Plugin::get_instance();
$plugin->initialize(__DIR__);


use YahnisElsts\PluginUpdateChecker\v5\PucFactory;
$myUpdateChecker = PucFactory::buildUpdateChecker(
	'https://member.breadfish.jp/wp-update-server/?action=get_metadata&slug=bf-ga4-tag-installer',
	__FILE__, //Full path to the main plugin file or functions.php.
	'bf-ga4-tag-installer'
);
