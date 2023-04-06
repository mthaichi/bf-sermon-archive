<h2><?php echo $title; ?></h2>
<form method="post" action="options.php">
<?php settings_fields( $setting_group_name ); ?>
<?php do_settings_sections( $setting_group_name ); ?>
<?php
if ( isset( $_GET['bf_favorite_cache_clear_action_done'] ) && $_GET['bf_favorite_cache_clear_action_done'] === '1' ) {
    echo '<div class="notice notice-success is-dismissible"><p>キャッシュのクリアが完了しました。</p></div>';
  }
?>
<table>
<tr>
<th>ユーザー名</th>
<td><input type="text" name="bf_favorite_pattern_username" value="<?php echo esc_attr( $get_option('bf_favorite_pattern_username') ); ?>"  pattern="[a-zA-Z0-9-_]+" title="半角英数でお願いします" /></td>
</tr>
<tr>
<th>API URL</th>
<td><input type="url" name="bf_favorite_pattern_api_url" value="<?php echo esc_attr( $get_option('bf_favorite_pattern_api_url') ); ?>"  /></td>
</tr>
</table>
<?php submit_button(); ?>
</form>

<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
  <input type="hidden" name="action" value="bf_favorite_cache_clear_action">
  <?php wp_nonce_field( 'bf_favorite_cache_clear_action', 'bf_favorite_cache_clear_action_nonce' ); ?>

  <input type="submit" value="キャッシュクリア" class="button button-primary">
</form>