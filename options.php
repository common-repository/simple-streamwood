<div class="wrap">
<h2>Simple StreamWood</h2>

<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>
<?php settings_fields('simple-streamwood'); ?>

<table class="form-table">

<tr valign="top">
	<th scope="row">StreamWood Key:</th>
	<td><input type="text" name="simple_streamwood_key" value="<?php echo get_option('simple_streamwood_key'); ?>" /></td>
</tr>

<tr valign="top">
	<th scope="row">StreamWood Domain Key:</th>
	<td><input type="text" name="simple_streamwood_domain_key" value="<?php echo get_option('simple_streamwood_domain_key'); ?>" /></td>
</tr>

</table>

<input type="hidden" name="action" value="update" />

<p class="submit">
	<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>
