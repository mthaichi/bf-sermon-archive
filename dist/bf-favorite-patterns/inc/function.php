<?php
namespace BF_Favorite_Patterns;

function get_option ( $key ) {
    $plugin = Plugin::get_instance();
    return $plugin->option_page->get_option( $key );

}