<?php
namespace BF_PluginBase;
class OptionPage extends \BF_PluginBase\OptionPage {

    protected $page_title = 'BF Plugin Base';
    protected $menu_title = 'BF Plugin Base';
    protected $slug = 'bF-plugin-base';
    protected $setting_group_name = 'bf_plugin_base_settings';

    /**
     * default option
     *
     * @var array
     */
    protected $options = array(
//        array('bf_plugin_base_settings_api_url', 'https://member.breadfish.jp/wp-json/vk-patterns/v1/status'),
    );
    protected $view = 'option-page.php';

    public function initialize() {
        parent::initialize();
    }

    public function view() {
        $this->set_vars( 'title', $this->page_title ); 
        $this->set_vars( 'setting_group_name', $this->setting_group_name );    
        $this->set_vars( 'get_option', array( $this, 'get_option' ) );
        parent::view();
    }
}

