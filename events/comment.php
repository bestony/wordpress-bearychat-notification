<?php

add_action('comment_post', 'bearychat_notify_hook_comment_post', 10, 2);
function bearychat_notify_hook_comment_post($comment_id, $approved)
{
    $options = get_option('bearychat_notify_settings');
    if ($options['bearychat_notify_new_comment_event']) {
        $api = new BearyChatAPI();

        if ('spam' === $approved) {
            return false;
        }

        $comment = get_comment($comment_id);

        if (is_wp_error($comment)) {
            return false;
        }
        $post = get_post($comment->comment_post_ID);
    
        $attachments = array(
			
            array(
                'title' => __('Comment Content', 'bearychat-notify'),
                'text' => $comment->comment_content,
			),
			array(
                'title' => __('Comment Author', 'bearychat-notify'),
                'text' => $comment->comment_author,
			),
			array(
				'title' => __('See Post', 'bearychat-notify'),
				'url' => get_permalink($post)
			)
        );

        $api->requestWithAttachments(__('New Comments', 'bearychat-notify'), $attachments);
    }

}
