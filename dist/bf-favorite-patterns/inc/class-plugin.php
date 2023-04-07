<?php
namespace BF_Favorite_Patterns;
class Plugin extends \BF_Plugin_Base\Plugin {

    protected $version = '0.0.1';

    public \BF_Plugin_Base\View $view;
    public \BF_Plugin_Base\Input $input;

    public function initialize( $base_dir ) {

        parent::initialize( $base_dir );
        $block_dir = $this->base_dir . '/build';
        
        $this->view = new \BF_Plugin_Base\View( $this );

        $this->input = new \BF_Plugin_Base\Input();
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

