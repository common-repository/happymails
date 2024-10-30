<?php
/**
 * Plugin Name: HappyMails
 * Plugin URI: http://fitwp.com
 * Description: Send happy birthday emails to users.
 * Version: 1.0
 * Author: FitWP
 * Author URI: http://fitwp.com
 * License: GPL2+
 * Text Domain: happymails
 * Domain Path: /languages/
 */

define( 'HAPPYMAILS_DIR', plugin_dir_path( __FILE__ ) );
define( 'HAPPYMAILS_URL', plugin_dir_url( __FILE__ ) );

require HAPPYMAILS_DIR . 'inc/class-happymails-composer.php';
require HAPPYMAILS_DIR . 'inc/class-happymails-cron.php';
require HAPPYMAILS_DIR . 'inc/class-happymails-user.php';
require HAPPYMAILS_DIR . 'inc/class-happymails-list-user.php';
new HappyMails_Composer;
new HappyMails_User;
new HappyMails_List_User;
new HappyMails_Cron;
