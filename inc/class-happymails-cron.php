<?php

/**
 * This class to handling scheduled send mail to user .
 */
class HappyMails_Cron {

	/**
	 * Add hook and run cron send mail.
	 */
	public function __construct() {
		$timestamp = wp_next_scheduled( 'happymails_send' );
		if ( ! $timestamp ) {
			wp_schedule_event( current_time( 'timestamp', true ) + 10, 'daily', 'happymails_send' );
		}

		add_action( 'happymails_send', array( $this, 'send_mails' ) );
	}

	/**
	 * Send mail to all user birthday is today.
	 */
	public function send_mails() {
		$option  = get_option( 'happymails_data' );
		$subject = isset( $option['title'] ) ? $option['title'] : '';
		$content = isset( $option['content'] ) ? $option['content'] : '';
		$emails  = HappyMails_List_User::get_list_user_birthday();
		wp_mail( $emails, $subject, $content, array( 'Content-Type: text/html; charset=UTF-8' ) );
	}
}