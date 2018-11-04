<?php
add_action('transition_post_status', 'bearychat_notify_hook_page', 10, 3);
function bearychat_notify_hook_page($new_status, $old_status, $page)
{
    $options = get_option('bearychat_notify_settings');
    $api = new BearyChatAPI();

    if (empty($page) || !is_object($page)) {
        return false;
    }

    if ('page' !== $page->post_type) {
        return false;
    }
    if ($options['bearychat_notify_page_publish_event']) {
        if ('publish' === $new_status && 'publish' !== $old_status) {
            $user = get_user_by('ID', $page->post_author);
			$title = sprintf(__('%s Publish new Page %s', 'bearychat-notify'),$user->display_name,$page->post_title);
			$api->requestWithPage($title,$page);
        }
    }
    if ($options['bearychat_notify_page_future_event']) {
        if ('future' === $new_status && 'future' !== $old_status) {
            $title = sprintf(__('Page %s Will Publish at %s', 'bearychat-notify'), $page->post_title, get_the_date(null, $page->ID));
            $api->requestWithPage($title, $page);

        }
    }
    if ($options['bearychat_notify_page_pending_event']) {
        if ('pending' === $new_status && 'pending' !== $old_status) {
            $user = get_user_by('ID', $page->post_author);
            $title = sprintf(__('%s Create Page %s is Pending', 'bearychat-notify'), $user->display_name, $page->post_title);
            $api->requestWithPage($title, $page);

        }
    }

}

add_action('publish_to_publish', 'bearychat_notify_hook_page_update');
function bearychat_notify_hook_page_update($page)
{

    $options = get_option('bearychat_notify_settings');
    $api = new BearyChatAPI();

    if ($options['bearychat_notify_page_updated_event']) {

        if (empty($page) || !is_object($page)) {
            return false;
        }

        if ('page' !== $page->post_type) {
            return false;
        }

        $title = sprintf(__('%s has updated.', 'bearychat-notify'), $page->post_title);
        $api->requestWithPage($title,$page);

    }
}

add_action('trash_page', 'bearychat_notify_hook_page_trashed');
function bearychat_notify_hook_page_trashed($page_id)
{
	$options = get_option('bearychat_notify_settings');
$api = new BearyChatAPI();


    if ($options['bearychat_notify_page_trashed_event']) {
        $page = get_post($page_id);

        if (is_wp_error($page)) {
            return false;
        }

        if ('page' !== $page->post_type) {
            return false;
        }
        $user = get_user_by('ID', $page->post_author);
        $title = sprintf(__("%s was trashed.", 'bearychat-notify'), $page->post_title);
        $api->request($title);
    }
}
