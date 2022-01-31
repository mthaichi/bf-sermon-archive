<?php

namespace VKBase;

class Options extends BaseObject {

    private $prefix;

    public function __construct( $prefix = '' )
    {
        $this->prefix = $prefix;
    }

    public function get( $key ) { 
        get_option( $this->prefix . '-' .  $key);
    }

    public function update( $key, $value ) {
        update_option( $this->prefix . '-' .  $key, $value);
    }


}