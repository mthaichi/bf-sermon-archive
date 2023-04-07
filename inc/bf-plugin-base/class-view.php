<?php

namespace BF_PluginBase;

//use divengine;

class View extends BaseObject {

    protected $base_dir;

    protected $view_file;

    public function __construct( Plugin $plugin, $base_dir = null ) {
        if ( is_null( $base_dir ) ) {
            $this->base_dir = $plugin->base_dir() . '/view/';
        }
    }
    public function render ( $view_file, $vars ) {
        extract($vars);
        include $this->base_dir . $view_file;
    }
}