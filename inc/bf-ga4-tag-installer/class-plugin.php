<?php
namespace BF_Ga4TagInstaller;
class Plugin extends \BF_PluginBase\Plugin {

    protected $version = '0.0.1';

    public \BF_PluginBase\View $view;
    public \BF_PluginBase\Input $input;

    public function initialize( $base_dir ) {

        parent::initialize( $base_dir );
        $block_dir = $this->base_dir . '/build';
        
        $this->view = new \BF_PluginBase\View( $this );

        $this->input = new \BF_PluginBase\Input();
  
        $this->option_page = new OptionPage($this);
        $this->option_page->initialize();

        $this->ga4_tag_output = new Ga4TagOutput($this);
        $this->ga4_tag_output->activate_action();
    }
}

