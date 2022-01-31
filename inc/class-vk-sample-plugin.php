<?php

class VK_SamplePlugin extends VKBase\Plugin {

    protected $version = '0.0.1';

    public function initialize() {
        $block_dir = $this->base_dir . '/build';
        
        $base_block = new VK_BaseBlock($this, $block_dir . '/base');
        $base_block->initialize();

        $marquee_block = new VK_MarqueeBlock($this, $block_dir . '/marquee');
        $marquee_block->initialize();

    }
}

