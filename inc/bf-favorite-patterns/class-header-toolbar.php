<?php 

namespace BF_FavoritePatterns;

class HeaderToolbar {
    use \BF_PluginBase\Singleton;

    function activate_actions () {
        add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_scripts' ) );       
    }

    function enqueue_scripts() {
        $asset = include '../build/header-toolbar/index.asset.php';
        wp_enqueue_script( 
          'bf-patterns-header-toolbar-js', 
          BFFP_URL . '/build/header-toolbar/index.js', 
          $asset['dependencies'], 
          $asset['version'], 
          true 
        );
        
        wp_enqueue_style( 
          'bf-patterns-header-toolbar-css', 
          BFFP_URL . '/build/header-toolbar/style-index.css' 
        );
      }

}