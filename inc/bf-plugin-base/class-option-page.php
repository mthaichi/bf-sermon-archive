<?php

namespace BF_PluginBase;

class OptionPage extends BaseObject {

    protected $page_title;

    protected $menu_title;

    protected $slug;

    protected Plugin $plugin;

    protected $setting_group_name;

    protected $options;

    protected $view;

    public function __construct( Plugin $plugin ) {
        $this->plugin = $plugin;
    }

    public function set_menu_title ( $menu_title ) {
        $this->menu_title = $menu_title;
    }

    public function set_page_title ( $page_title ) {
        $this->page_title = $page_title;
    }

    public function initialize() {
        add_action( 'admin_menu', function() {
            add_options_page( $this->page_title, $this->menu_title, 'manage_options', $this->slug, array(
                $this,
                'view' 
            ) );
        } );
        $this->settings_init();
    }

    public function settings_init() {
        foreach( $this->options as $option ) {
            if ( 2 < count( $option ) ) {
                register_setting( $this->setting_group_name, $option[0], $option[2] );
            } else {
                register_setting( $this->setting_group_name, $option[0]);
            }
        }
    }

    function get_default( $option_name ) {
        foreach( $this->options as $option ) {
            if ( $option[0] === $option_name ) {
                return $option[1];
            }
        }
    }

    function get_option( $option_name ) {
        $value = get_option($option_name);
        if (empty($value)) {
            $value = $this->get_default( $option_name );
        }
        return $value;
    }

    public function set_vars($key, $value) {
        $this->vars[$key] = $value;
    }

    public function view() {

        echo $this->plugin->view->render($this->view, $this->vars);
    }

}
