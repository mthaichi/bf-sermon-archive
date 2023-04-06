<?php

namespace BFBase;
class Plugin extends BaseObject {
    
    use Singleton;

    protected $version;
    protected $base_dir = '';

    public function initialize( $base_dir ) {
        $this->base_dir = $base_dir;        
    }

    public function base_dir() {
        return $this->base_dir;
    }

    public function get_version() {
        return $this->version;
    }
}