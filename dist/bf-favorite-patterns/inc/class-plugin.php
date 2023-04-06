<?php
namespace BF_FavoritePatterns;
class Plugin extends \BFBase\Plugin {

    protected $version = '0.0.1';

    public \BFBase\View $view;
    public \BFBase\Input $input;

    public function initialize( $base_dir ) {

        parent::initialize( $base_dir );
        $block_dir = $this->base_dir . '/build';
        
        $this->view = new \BFBase\View( $this );

        $this->input = new \BFBase\Input();
       /* 
        $base_block = new SampleBlock($this, $block_dir . '/sample');
        $base_block->initialize();

        $marquee_block = new MarqueeBlock($this, $block_dir . '/marquee');
        $marquee_block->initialize();
*/
        $this->option_page = new OptionPage($this);
        $this->option_page->initialize();

        $this->pattern_manager = FavoritePatternManager::get_instance();
        $this->pattern_manager->activate_actions();

        $this->header_toolbar = HeaderToolber::get_instance();
        $this->header_toolbar->activate_actions();
  
    }
}

