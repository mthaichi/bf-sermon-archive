<?php
namespace BF_Ga4TagInstaller;
class Ga4TagOutput extends \BF_PluginBase\View {

    function activate_action() {
        add_action( 'wp_head', function() {
            echo $this->render('ga4tag.php', array(
                'gtag_id' => $this->plugin->option_page->get_option( 'bfga4_tagm_measurement_id' )
            ));
        }, 10000 );
    }
    
}