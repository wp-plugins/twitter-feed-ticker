<?php
add_action( 'admin_init', 'ag_twitter_options_init' );
add_action( 'admin_menu', 'ag_twitter_options_add_page' );
/**
 * Init plugin options to white list our options
 */
function ag_twitter_options_init(){
	register_setting( 'ag_twitter_options', 'ag_twitter_options', 'ag_twitter_options_validate' );
}
/**
 * Load up the menu page
 */
function ag_twitter_options_add_page() {
	add_options_page( 'Twitter Options' , 'Twitter Options', 'edit_theme_options', 'ag_twitter_options', 'ag_twitter_options_do_page' );
}
/**
 * Create the options page
 */
function ag_twitter_options_do_page() {
	global $select_options, $radio_options;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
<div class="wrap">
  <?php screen_icon(); echo "<h2>Twitter Options</h2>"; ?>
  <?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
  <div class="updated fade">
    <p><strong>
      <?php _e( 'Options saved', 'ag_twitter' ); ?>
      </strong></p>
  </div>
  <?php endif; ?>
  <form method="post" action="options.php">
    <?php settings_fields( 'ag_twitter_options' ); ?>
    <?php $options = get_option( 'ag_twitter_options' ); ?>
    <table class="form-table">
        <?php
				/**
				 * CONSUMER_KEY
				 */
	?>
      <tr valign="top">
        <th scope="row"><?php _e( 'CONSUMER_KEY', 'ag_twitter' ); ?></th>
        <td><input id="ag_twitter_options[ag_key]" size="100" type="text" name="ag_twitter_options[ag_key]" value="<?php esc_attr_e( $options['ag_key'] ); ?>" />
          <label class="description" for="ag_twitter_options[ag_key]">
            <?php _e( 'Twitter CONSUMER_KEY', 'ag_twitter' ); ?>
          </label></td>
      </tr>
        <?php
				/**
				 * CONSUMER_SECRET
				 */
				?>
      <tr valign="top">
        <th scope="row"><?php _e( 'CONSUMER_SECRET', 'ag_twitter' ); ?></th>
        <td><input id="ag_twitter_options[ag_secret]" size="100" type="text" name="ag_twitter_options[ag_secret]" value="<?php esc_attr_e( $options['ag_secret'] ); ?>" /></td>
      </tr>
    </table>
    <p class="submit">
      <input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'ag_twitter' ); ?>" />
    </p>
  </form>
</div>
<?php 
}
/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function ag_twitter_options_validate( $input ) {
	global $select_options, $radio_options;

	// Say our text option must be safe text with no HTML tags
	$input['ag_key'] = wp_filter_nohtml_kses( $input['ag_key'] );
	$input['ag_secret'] = wp_filter_nohtml_kses( $input['ag_secret'] );

	return $input;
}
?>