<h2><?php echo $title; ?></h2>
<form method="post" action="options.php">
<?php settings_fields( $setting_group_name ); ?>
<?php do_settings_sections( $setting_group_name ); ?>
<table>
<tr>
<th>API URL</th>
<td><input type="url" name="bf_plugin_base_settings_api_url" value="<?php echo esc_attr( $get_option('bf_plugin_base_settings_api_url') ); ?>"  /></td>
</tr>
</table>
<?php submit_button(); ?>
</form>

