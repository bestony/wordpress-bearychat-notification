<?php

function bearycaht_notify_get_user_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }

}

add_action('user_register', 'bearychat_notify_hook_user_register');
function bearychat_notify_hook_user_register($user_id)
{
    $options = get_option('bearychat_notify_settings');
    $api = new BearyChatAPI();
    if ($options['bearychat_notify_user_reg_event']) {
        $user = get_user_by('id', $user_id);

        if (false === $user) {
            return false;
        }
        $message = sprintf(__('New User Register: %s', 'bearychat-notify'), get_bloginfo('name'));
        $attacoments = array(
            array(
                'title' => __('User Name', 'bearychat-notify'),
                'text' => $user->display_name,
                'color' => '#d1f6c1',
            ),
            array(
                'title' => __('User Email', 'bearychat-notify'),
                'text' => $user->user_email,
                'color' => '#d1f6c1',
            ),
        );
        $api->requestWithAttachments($message, $attacoments);
    }

}

add_action('wp_login', 'bearychat_notify_hook_wp_login',10,2);
function bearychat_notify_hook_wp_login($username, $user)
{
    $options = get_option('bearychat_notify_settings');
    $api = new BearyChatAPI();

    if (!in_array('administrator', $user->roles)) {
        return false;
    }
    if ($options['bearychat_notify_admin_login_event']) {
        $message = __('Administrator Login Notification', 'bearychat-notify');
        $attacoments = array(
            array(
                'title' => __('Administrator Name', 'bearychat-notify'),
                'text' => $user->display_name,
                'color' => '#0c907d',
            ),
            array(
                'title' => __('Administrator Email', 'bearychat-notify'),
                'text' => $user->user_email,
                'color' => '#0c907d',
            ),
            array(
                'title' => __('Administrator IP Address', 'bearychat-notify'),
                'text' => bearycaht_notify_get_user_ip(),
                'color' => '#0c907d',
            ),
        );
        $api->requestWithAttachments($message, $attacoments);

    }
}

add_action('wp_login_failed', 'bearychat_notify_hook_wp_login_failed');
function bearychat_notify_hook_wp_login_failed($username)
{
    $options = get_option('bearychat_notify_settings');
    $api = new BearyChatAPI();

    if ($options['bearychat_notify_admin_failed_login_event']) {
        $message = __('Administrator Login Faild Alert', 'bearychat-notify');
        $attacoments = array(
            array(
                'title' => __('Username', 'bearychat-notify'),
                'text' => $username,
                'color' => '#ff0000',
            ),
            array(
                'title' => __('IP Address', 'bearychat-notify'),
                'text' => bearycaht_notify_get_user_ip(),
                'color' => '#ff0000',
            ),
        );
        $api->requestWithAttachments($message, $attacoments);

    }
}
