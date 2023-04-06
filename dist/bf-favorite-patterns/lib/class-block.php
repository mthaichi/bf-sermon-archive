<?php

namespace BFBase;

 class Block extends BaseObject {

    protected $block_dir;
    protected $plugin;

    public function __construct( Plugin $plugin, $block_dir = null ) {
        $this->plugin = $plugin;
        $this->block_dir = $block_dir ? $block_dir : __DIR__;
    }

    public function initialize() {
        add_action( 'init', array( $this, 'register' ) );
    }

    public function register() {
        register_block_type( $this->block_dir );
    }




}