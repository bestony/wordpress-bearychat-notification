<?php

class BearyChatAPI
{
    protected $method = 'POST';
    protected $options;
    public function __construct()
    {
        $this->options = get_option('bearychat_notify_settings');
    }
    public function request(string $message, string $url = null, string $url_title = null)
    {
        if ($url == null) {
            $body = json_encode(array('text' => $message));
        } else {
            if ($url_title == null) {
                $body = json_encode(array(
                    'text' => $message,
                    'attachments' => array(array(
                        'title' => '点击查看详情',
                        'url' => $url,
                    )),
                ));

            } else {
                $body = json_encode(array(
                    'text' => $message,
                    'attachments' => array(array(
                        'title' => $url_title,
                        'url' => $url,
                    )),
                ));

            }
        }

        $result = wp_remote_request($this->options['bearychat_notify_webhook_url'], array(
            'method' => 'POST',
            'headers' => array('Content-Type' => 'application/json'),
            'body' => $body,
        ));
    }
    public function requestWithOrder(string $message, $order)
    {
        $body = json_encode(array(
            'text' => $message,
            'attachments' => array(
                array(
                    'title' => __('Order ID', 'bearychat-notify'),
                    'text' => $order->get_order_number(),
                    'color' => '#74b49b',
                ),
                array(
                    'title' => __('Order Status', 'bearychat-notify'),
                    'text' => ucwords($order->get_status()),
                    'color' => '#74b49b',
                ),
                array(
                    'title' => __('Order Total', 'bearychat-notify'),
                    'text' => html_entity_decode(strip_tags(wc_price($order->get_total()))),
                    'color' => '#74b49b',
                ),
                array(
                    'title' => __('Payment Gateway', 'bearychat-notify'),
                    'text' => $order->get_payment_method_title(),
                    'color' => '#74b49b',
                ),
                array(
                    'title' => __('See Order Detail', 'bearychat-notify'),
                    'color' => '#2c3848',
                    'url' => get_edit_post_link($order->get_order_number()),
                ),
            ),
        ));
        $result = wp_remote_request($this->options['bearychat_notify_webhook_url'], array(
            'method' => 'POST',
            'headers' => array('Content-Type' => 'application/json'),
            'body' => $body,
        ));

    }
    public function requestWithAttachments(string $message, $attachment)
    {
        $body = json_encode(array(
            'text' => $message,
            'attachments' => $attachment,
        ));
        $result = wp_remote_request($this->options['bearychat_notify_webhook_url'], array(
            'method' => 'POST',
            'headers' => array('Content-Type' => 'application/json'),
            'body' => $body,
        ));

    }
    public function requestWithPost(string $message, $post)
    {
        $body = json_encode(array(
            'text' => $message,
            'attachments' => array(
                array(
                    'title' => __('Post ID', 'bearychat-notify'),
                    'text' => $post->ID,
                    'color' => '#706381',
                ),
                array(
                    'title' => __('Post Title', 'bearychat-notify'),
                    'text' => $post->post_title,
                    'color' => '#706381',
                ),
                array(
                    'title' => __('Post Author', 'bearychat-notify'),
                    'text' => get_user_by('ID', $post->post_author)->display_name,
                    'color' => '#706381',
                ),

                array(
                    'title' => __('Edit Post >>', 'bearychat-notify'),
                    'color' => '#2c3848',
                    'url' => get_edit_post_link($post->ID),
                ),
                array(
                    'title' => __('See Post >>', 'bearychat-notify'),
                    'color' => '#2c3848',
                    'url' => get_permalink($post),
                ),
            ),
        ));
        $result = wp_remote_request($this->options['bearychat_notify_webhook_url'], array(
            'method' => 'POST',
            'headers' => array('Content-Type' => 'application/json'),
            'body' => $body,
        ));

    }
    public function requestWithPage(string $message, $page)
    {

        $body = json_encode(array(
            'text' => $message,
            'attachments' => array(
                array(
                    'title' => __('Page Title', 'bearychat-notify'),
                    'text' => $page->post_title,
                    'color' => '#706381',
                ),
                array(
                    'title' => __('Page Author', 'bearychat-notify'),
                    'text' => get_user_by('ID', $page->post_author)->display_name,
                    'color' => '#706381',
                ),

                array(
                    'title' => __('Edit Page >>', 'bearychat-notify'),
                    'color' => '#2c3848',
                    'url' => get_edit_post_link($page->ID),
                ),
                array(
                    'title' => __('See Page >>', 'bearychat-notify'),
                    'color' => '#2c3848',
                    'url' => get_permalink($page),
                ),
            ),
        ));
        $result = wp_remote_request($this->options['bearychat_notify_webhook_url'], array(
            'method' => 'POST',
            'headers' => array('Content-Type' => 'application/json'),
            'body' => $body,
        ));

	}
	
}
