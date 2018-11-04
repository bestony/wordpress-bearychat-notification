<?php
add_action('wp_version_check', 'bearychat_notify_hook_wordpress_update');
function bearychat_notify_hook_wordpress_update()
{
    $options = get_option('bearychat_notify_settings');
    $api = new BearyChatAPI();
    if ($options['bearychat_notify_wordpress_update_event']) {
        $version_data = get_site_transient('update_core');

        if (false === $version_data) {
            return false;
        }

        if (!is_object($version_data) || !isset($version_data->updates[0])) {
            return false;
        }

        if ('upgrade' !== $version_data->updates[0]->response) {
            return false;
		}
		$saved_version = get_option( 'bearychat_notify_wordpress_version');
		if ( $saved_version !== $version_data->updates[ 0 ]->current ) {
			update_option('bearychat_notify_wordpress_version', $version_data->updates[0]->current);
			$message = sprintf(__('New WordPress available, now at %s ,and new is %s', 'bearychat-notify'),$version_data->version_checked,$version_data->updates[ 0 ]->current);
			$api->request($message);
		}


    }
}
