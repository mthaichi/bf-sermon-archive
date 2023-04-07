<?php
namespace BF_FavoritePatterns;

class FavoritePatternManager {

    use \BF_PluginBase\Singleton;

    private $transient_name = 'BF_FavoritePatterns_api_data';

    public function activate_actions() {
        add_action( 'load-post.php', array( $this, 'reload_pattern_api_data' ) );
        add_action( 'load-post-new.php', array( $this, 'reload_pattern_api_data' ) );
        add_action( 'load-site-editor.php', array( $this, 'reload_pattern_api_data' ) );
        add_action( 'init', array( $this, 'register_patterns' ) );
    }
    
    /**
     * 編集画面を開いた時点で条件付きでキャッシュをクリア
     */
    function reload_pattern_api_data() {

        // キャッシュの有効時間（秒）.
        $cache_time = 1;

        // 最後にキャッシュされた時間を取得.
        $last_cached = get_option('bf_favorite_pattern_last_pattern_cached');

        // 現在の時刻を取得.
        $current_time = date( 'Y-m-d H:i:s' );
        // 差分を取得・キャッシュが初めてならキャッシュの有効時間が経過したものとみなす.
        $diff = ! empty( $last_cached ) ? strtotime( $current_time ) - strtotime( $last_cached ) : $cache_time + 1;

        // フラグがなければパターンのデータのキャッシュをパージ.
        if ( $diff > $cache_time ) {
            // パターンのデータのキャッシュをパージ.
            delete_transient( $this->transient_name );

            // 最低１時間はキャッシュを保持.
            update_option( 'bf_favorite_pattern_last_pattern_cached', $current_time );
        }
    }

    /**
     * パターンを登録
     *
     * @param array  $api テスト用に用意した API を読み込む変数（通常は空）.
     * @param string $template テスト用に用意した現在のテーマが何かを読み込む変数（通常は空）.
     *
     * @return array{
     *  'favorite' => array(),
     *  'x-t9'    => array()
     * } $returnx : 成功したらそれぞれの配列に true が入ってくる.
     */
    function register_patterns( $api = null, $template = null ) {
   
        // テスト用の結果を返す配列.
        $result = array(
            'favorite' => array(),
            'x-t9'     => array(),
        );
       
        $username = get_option('bf_favorite_pattern_username');

        if ( ! empty( $username ) ) {
            $pattern_api_data = ! empty( $api ) ? $api : $this->get_pattern_api_data();
            $current_template = ! empty( $template ) ? $template : get_template();
           //_dump($pattern_api_data);
            if ( ! empty( $pattern_api_data ) && is_array( $pattern_api_data ) ) {
                if ( ! empty( $pattern_api_data['patterns'] ) ) {
                    $patterns_data = $pattern_api_data['patterns'];

                    if ( function_exists( 'mb_convert_encoding' ) ) {
                        $patterns_data = mb_convert_encoding( $patterns_data, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN' );
                    }

                    $patterns = json_decode( $patterns_data, true );
                    register_block_pattern_category(
                        'bf-favorite-patterns',
                        array(
                            'label' => __( 'BFお気に入りパターン', 'bf-favorite-patterns' ),
                        )
                    );

                   

                    if ( ! empty( $patterns ) && is_array( $patterns ) ) {
                        foreach ( $patterns as $pattern ) {
                            $result['favorite'][] = register_block_pattern(
                                $pattern['post_name'],
                                array(
                                    'title'      => $pattern['title'],
                                    'categories' => $pattern['categories'],
                                    'content'    => $pattern['content'],
                                )
                            );
                        }
                    }
                }

                if ( 'x-t9' === $current_template && empty( $options['disableXT9Pattern'] ) ) {
                    if ( ! empty( $pattern_api_data['x-t9'] ) ) {
                        $patterns_data = $pattern_api_data['x-t9'];

                        if ( function_exists( 'mb_convert_encoding' ) ) {
                            $patterns_data = mb_convert_encoding( $patterns_data, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN' );
                        }

                        $patterns = json_decode( $patterns_data, true );
                        register_block_pattern_category(
                            'x-t9',
                            array(
                                'label' => __( 'X-T9', 'bf-favorite-patterns' ),
                            )
                        );
                        if ( ! empty( $patterns ) && is_array( $patterns ) ) {
                            foreach ( $patterns as $pattern ) {
                                $result['x-t9'][] = register_block_pattern(
                                    $pattern['post_name'],
                                    array(
                                        'title'      => $pattern['title'],
                                        'categories' => $pattern['categories'],
                                        'content'    => $pattern['content'],
                                    )
                                );
                            }
                        }
                    }
                }
            }
        }
        return $result;
    }

    /**
     * API のデータをキャッシュに格納
     *
     * @return array{
     *      array {
     *      role: string,
     *      title: string,
     *      categories: array,
     *      content: string,
     *  }
     * } $return
     */
    function get_pattern_api_data() {

        // メールアドレスを取得.
        $username = get_option('bf_favorite_pattern_username');
        $username = ! empty( $username ) ? $username : '';

        // パターン情報をキャッシュデータから読み込み読み込み.
        $transients = get_transient( $this->transient_name );

        // デフォルトの返り値.
        $return = '';

        if ( ! empty( $username ) ) {
            // パターンのキャッシュがあればキャッシュを読み込み.
            if ( ! empty( $transients ) ) {
                $return = $transients;
            } else {
                // キャッシュがない場合 API を呼び出しキャッシュに登録.
                $result = wp_remote_post(
                    'https://member.breadfish.jp/wp-json/vk-patterns/v1/status',
                    array(
                        'timeout' => 10,
                        'body'    => array(
                            'login_id' => $username,
                        ),
                    )
                );
                if ( ! empty( $result ) && ! is_wp_error( $result ) ) {
                    $return = json_decode( $result['body'], true );
                    // APIで取得したパターンデータをキャッシュに登録. 1日 に設定.
                    set_transient( $this->transient_name, $return, 60 * 60 * 24 );
                }
            }
        }
        return $return;
    }

    function clear_cache() {
        delete_transient( $this->transient_name );
    }

}