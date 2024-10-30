<?php

/**
 * This class to handling add one field to edit user and save in user_meta database
 */
class HappyMails_User {
	/**
	 * Add hook to show and save field.
	 */
	public function __construct() {
		add_action( 'show_user_profile', array( $this, 'show_field' ) );
		add_action( 'edit_user_profile', array( $this, 'show_field' ) );

		add_action( 'personal_options_update', array( $this, 'save_field' ) );
		add_action( 'edit_user_profile_update', array( $this, 'save_field' ) );
	}

	/**
	 * Add more one field in table user to add birthday.
	 *
	 * @param $user
	 */
	public function show_field( $user ) {
		?>
		<h3><?php esc_html_e( 'Birthday', 'happymails' ) ?></h3>

		<table class="form-table">

			<tr>
				<th><label for="birthday"><?php esc_html_e( 'Birthday', 'happymails' ) ?></label></th>
				<td>
					<input type="text" name="birthday" id="birthday" value="<?php echo esc_attr( get_user_meta( $user->ID, 'birthday', true ) ); ?>" class="regular-text"/><br/>
                    <span class="description"> <?php esc_html_e( 'Please enter your birthday . Format', 'happymails' ) ?><code>MM / DD / YYYY </code>.</span>
				</td>
			</tr>

		</table>
		<?php
	}

	/**
	 * Save data in birthday field to database user_meta.
	 *
	 * @param $user_id
	 */
	public function save_field( $user_id ) {
		if ( ! current_user_can( 'edit_user', $user_id ) ) {
			return;
		}

		update_user_meta( $user_id, 'birthday', $_POST['birthday'] );
	}
}