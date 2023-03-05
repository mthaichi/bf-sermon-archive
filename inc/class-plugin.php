<?php
namespace BF_FavoritePatterns;
class Plugin extends \BFBase\Plugin {

    protected $version = '0.0.1';

    public function initialize() {
        $block_dir = $this->base_dir . '/build';
        
        $base_block = new SampleBlock($this, $block_dir . '/sample');
        $base_block->initialize();

        $marquee_block = new MarqueeBlock($this, $block_dir . '/marquee');
        $marquee_block->initialize();

        $option_page = new OptionPage($this);
        $option_page->initialize();
    }
}

