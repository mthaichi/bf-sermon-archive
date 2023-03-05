<?php

namespace BFBase;
class Plugin extends BaseObject {

    protected $version;
    protected $base_dir = '';

    public function __construct( $base_dir ) {
        $this->base_dir = $base_dir;
    }
  
    public function initialize() {
        
    }

    public function get_version() {
        return $this->version;
    }
}