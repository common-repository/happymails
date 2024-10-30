<?php

/**
 * This class create a list user has birthday is today
 */
class HappyMails_List_User {

	/**
	 * Add hook to run function get_list_user_birthday.
	 */
	public function __construct() {
		add_action( 'toplevel_page_happymails-composer', array( __CLASS__, 'get_list_user_birthday' ) );
		add_action( 'load-profile.php', array( $this, 'happymails_script') );
	}
	/**
	 * Enqueue script to admin for birthday field.
	 */
	public function happymails_script(){
		wp_register_script( 'birthday_script', HAPPYMAILS_URL . '/js/script.js' );
		wp_enqueue_script( 'birthday_script' );
	}

	/**
	 * Get user has birthday in today.
	 *
	 * @return array
	 */
	public static function get_list_user_birthday() {
		$today    = date( 'm/d' );
		$users    = get_users();
		$count    = 1;
		$all_mails = [];
		//loop to find user birthday today.
		foreach ( $users as $user ) {

			$user_d = get_user_meta( $user->ID, 'birthday', true );
			$user_d = substr( $user_d, 0, 5 );
			if ( $user_d == $today ) {
				$count ++;
				if ( $count == 2 ) {
					echo '<h2>List user birth to day: ' . $today . '.</h2>';
				}
				echo '<span>' . intval($count-1) . '/<b>' . esc_html( $user->display_name ) . '</b>' . '</span>: ' . esc_html( $user->user_email ) . '<br />';
				$all_mails[] = $user->user_email;
			}
		}
		if ( $count == 1 ) {
			self::no_user_birthday();
		}
		return $all_mails;
	}

	/**
	 * This function to run if no user has birthday today.
	 */
	public static function no_user_birthday() { ?>
		<br/ >
		<div class="update-nag">
			<?php esc_html_e( 'Today no user birthday !', 'happymails' ); ?>
		</div>
		<?php
	}
}