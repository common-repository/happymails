<?php

/**
 * This class to handling display form in admin page.
 */
class HappyMails_Composer {
	/**
	 * Add function to hook.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/**
	 * Add more menu to sidebar left in admin.
	 */
	public function add_menu() {
		add_menu_page(
			esc_html__( 'Happy Mails Compose', 'happymails' ),
			esc_html__( 'Happy Mails', 'happymails' ),
			'manage_options',
			'happymails-composer',
			array( $this, 'form' ),
			HAPPYMAILS_URL . '/images/mail.png'
		);
	}

	/**
	 * Display form in admin page with field.
	 */
	public function form() {
		?>
		<div class="wrap">
			<form method="POST" action="options.php">
				<?php
				settings_fields( 'happymails_setting' );
				do_settings_sections( 'happymails-composer' );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Register setting two field , title and content.
	 */
	public function register_settings() {
		register_setting( 'happymails_setting', 'happymails' );

		add_settings_section(
			'general',
			esc_html__( 'Compose emails to send', 'happymails' ),
			'',
			'happymails-composer'
		);

		add_settings_field(
			'title',
			esc_html__( 'Title', 'happymails' ),
			array( $this, 'render_title' ),
			'happymails-composer',
			'general'
		);

		add_settings_field(
			'content',
			esc_html__( 'Content', 'happymails' ),
			array( $this, 'render_content' ),
			'happymails-composer',
			'general'
		);
	}

	/**
	 * Output field title.
	 */
	public function render_title() {
		$option = get_option( 'happymails' );
		$title  = isset( $option['title'] ) ? $option['title'] : '';
		echo '<input name="happymails[title]" type="text" class="widefat" value="' . esc_attr( $title ) . '">';
	}

	/**
	 * Output field content.
	 */
	public function render_content() {
		$option  = get_option( 'happymails' );
		$content = isset( $option['content'] ) ? $option['content'] : '';
		wp_editor( $content, 'happymails_content', array(
			'textarea_name' => 'happymails[content]',
		) );
	}

}