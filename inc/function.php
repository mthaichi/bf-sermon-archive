<?php
namespace BF_FavoritePatterns;

function get_option ( $key ) {
    $plugin = Plugin::get_instance();
    return $plugin->option_page->get_option( $key );

}