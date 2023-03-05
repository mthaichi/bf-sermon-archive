<?php

namespace BFBase;

class OptionPage extends BaseObject {

    protected $page_title;

    protected $menu_title;

    protected $slug;

    public function __construct( Plugin $plugin ) {
        $this->plugin = $plugin;

    }

    public function initialize() {
        add_action( 'admin_menu', function() {
            add_options_page( $this->page_title, $this->menu_title, 'manage_options', $this->slug, array(
                $this,
                'view' 
            ) );
        } );
    }

    protected function view(){}

}
