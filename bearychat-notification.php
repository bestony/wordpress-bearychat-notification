<?php
/*
Plugin Name:  Notifications For BearyChat
Plugin URI:   https://wpstore.app/archives/bearychat-notification/
Description:  A BearyChat Notification plugin, can send WordPress Event to your <a herf="https://bearychat.com">Bearychat</a> Channel.
Version:      0.1
Author:       Bestony
Author URI:   https://wpstore.app/

License:      GPLv3
License URI:  https://www.gnu.org/licenses/gpl-3.0.html
Text Domain:  bearychat-notify
Domain Path:  /languages
 */
include_once 'admin/init.php';
include_once 'inc/api.php';

include_once 'events/system.php';
include_once 'events/post.php';
include_once 'events/page.php';
include_once 'events/comment.php';
include_once 'events/user.php';
include_once 'events/woocommerce.php';

add_action('init', 'bearychat_notify_load_textdomain');
function bearychat_notify_load_textdomain() {
	load_plugin_textdomain('bearychat-notify', false, basename(dirname(__FILE__)) . '/languages');
}
