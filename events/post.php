<?php

/**
 * @group Posts
 */
add_action('transition_post_status', 'bearychat_notify_hook_post', 10, 3);

/**
 * 发布新的文章
 *
 * @param [type] $new_status
 * @param [type] $old_status
 * @param [type] $post
 * @return void
 */
function bearychat_notify_hook_post($new_status, $old_status, $post)
{
    $options = get_option('bearychat_notify_settings');
    $api = new BearyChatAPI();
    if (empty($post) || !is_object($post)) {
        return false;
    }

    if ('post' !== $post->post_type) {
        return false;
    }
    /**
     * 发布新文章
     */
    if ($options['bearychat_notify_post_publish_event']) {
        if ('publish' === $new_status && 'publish' !== $old_status) {
            $message = sprintf(__('New Post Publish: %s', 'bearychat-notify'), get_bloginfo('name'));
            $api->requestWithPost($message, $post);
        }
    }
    /**
     * 定时文章
     */
    if ($options['bearychat_notify_post_future_event']) {
        if ('future' === $new_status && 'future' !== $old_status) {
            $user = get_user_by('ID', $post->post_author);
            $message = sprintf(__('%s Create a new Post %s Will Publish at %s', 'bearychat-notify'), $user->display_name, $post->post_title, get_the_date(null, $post->ID));

            $api->requestWithPost($message, $post);

        }
    }

    /**
     * 等待审核文章
     */
    if ($options['bearychat_notify_post_pending_event']) {
        if ('pending' === $new_status && 'pending' !== $old_status) {
            $user = get_user_by('ID', $post->post_author);
            $message = sprintf(__('%s New Post %s is Pending.', 'bearychat-notify'), $user->display_name, $post->post_title);
            $api->requestWithPost($message, $post);

        }
    }

}

add_action('trashed_post', 'bearychat_notify_hook_post_update_trashed');
function bearychat_notify_hook_post_update_trashed($post)
{
    $options = get_option('bearychat_notify_settings');
    $api = new BearyChatAPI();
    if ($options['bearychat_notify_post_trashed_event']) {
        $post = get_post($post_id);

        if (is_wp_error($post)) {
            return false;
        }

        if ('post' !== $post->post_type) {
            return false;
        }

        $user = get_user_by('ID', $post->post_author);
        $title = sprintf(__('Post %s Was crashed', 'bearychat-notify'), $post->post_title);
        $api->request($title);
    }
}

add_action('publish_to_publish', 'bearychat_notify_hook_post_update');
function bearychat_notify_hook_post_update($post)
{
    $options = get_option('bearychat_notify_settings');
    $api = new BearyChatAPI();
    if (empty($post) || !is_object($post)) {
        return false;
    }

    if ('post' !== $post->post_type) {
        return false;
    }
    /**
     * 文章更新
     */
    if ($options['bearychat_notify_post_updated_event']) {
        $user = get_user_by('ID', $post->post_author);
        $message = sprintf(__("%s 's Post %s was updated.", 'bearychat-notify'), $user->display_name, $post->post_title);
        $api->requestWithPost($message, $post);

    }
}
