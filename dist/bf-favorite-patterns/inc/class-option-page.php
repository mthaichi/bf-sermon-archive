<?php
namespace BF_Favorite_Patterns;
class OptionPage extends \BF_Plugin_Base\OptionPage {

    protected $page_title = 'BF Favorite Patterns';
    protected $menu_title = 'BF Favorite Patterns';
    protected $slug = 'bF-favorite-page';
    protected $setting_group_name = 'bf_favorite_pattern_settings';
    protected $options = array(
        array('bf_favorite_pattern_username', ''),
        array('bf_favorite_pattern_api_url', 'https://member.breadfish.jp/wp-json/vk-patterns/v1/status'),
        array('bf_favorite_pattern_last_pattern_cached', '')
    );
    protected $view = 'option-page.php';

    public function initialize() {
        parent::initialize();
        add_action( 'admin_post_bf_favorite_cache_clear_action', function() {

            // nonceのチェック
            check_admin_referer( 'bf_favorite_cache_clear_action', 'bf_favorite_cache_clear_action_nonce' );

            $this->plugin->pattern_manager->clear_cache();

            // 処理が完了したら、リダイレクト先URLを設定する
            $redirect_url = add_query_arg( 'bf_favorite_cache_clear_action_done', '1', wp_get_referer() );

            // リダイレクトする
            wp_safe_redirect( $redirect_url );            

        } );
    }

    public function view() {
        $this->set_vars( 'title', $this->page_title ); 
        $this->set_vars( 'setting_group_name', $this->setting_group_name );    
        $this->set_vars( 'get_option', array( $this, 'get_option' ) );
        parent::view();
    }
}

