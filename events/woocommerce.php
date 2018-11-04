<?php

add_action('woocommerce_checkout_order_processed', 'bearychat_notify_new_order', 10, 1);
function bearychat_notify_new_order($order_id)
{
    $options = get_option('bearychat_notify_settings');
    if ($options['bearychat_notify_woo_new_order_event']) {
        if (empty($order_id)) {
            return false;
        }
        $order = wc_get_order($order_id);
        $api = new BearyChatAPI();
        $message = sprintf(__('%s has new Order.', 'bearychat-notify'), get_bloginfo('name'));
        $api->requestWithOrder($message, $order);

    }

}

add_action('woocommerce_order_status_changed', 'bearychat_notify_order_status_changed', 10, 3);
function bearychat_notify_order_status_changed($order_id, $status_form, $status_to)
{
    if (empty($order_id)) {
        return false;
    }

    $options = get_option('bearychat_notify_settings');
    $api = new BearyChatAPI();
    $order = wc_get_order($order_id);
    switch ($status_to) {
        case 'completed':
            if ($options['bearychat_notify_woo_order_completed_event']) {
                $api->requestWithOrder(sprintf(__('Order #%d marked as Completed.', 'bearychat-notify'), $order_id), $order);
            }
            break;
        case 'pending':
            if ($options['bearychat_notify_woo_order_pending_event']) {
                $api->requestWithOrder(sprintf(__('Order #%d marked as Pending.', 'bearychat-notify'), $order_id), $order);

            }
            break;
        case 'processing':
            if ($options['bearychat_notify_woo_order_processing_event']) {
                $api->requestWithOrder(sprintf(__('Order #%d marked as Processing.', 'bearychat-notify'), $order_id), $order);
            }
            break;
        case 'on-hold':
            if ($options['bearychat_notify_woo_order_on_hold_event']) {
                $api->requestWithOrder(sprintf(__('Order #%d marked as On Hold.', 'bearychat-notify'), $order_id), $order);
            }
            break;
        case 'cancelled':
            if ($options['bearychat_notify_woo_order_cancelled_event']) {
                $api->requestWithOrder(sprintf(__('Order #%d marked as Cancelled.', 'bearychat-notify'), $order_id), $order);
            }
            break;
        case 'refunded':
            if ($options['bearychat_notify_woo_order_refunded_event']) {
                $api->requestWithOrder(sprintf(__('Order #%d marked as Refunded.', 'bearychat-notify'), $order_id), $order);
            }
            break;
    }

};

add_action('woocommerce_new_customer_note', 'bearychat_notify_new_order_note', 10, 1);
function bearychat_notify_new_order_note($note_data)
{
    if (empty($note_data)) {
        return false;
    }

    $order = wc_get_order($note_data['order_id']);
    $options = get_option('bearychat_notify_settings');
    $api = new BearyChatAPI();
    if ($options['bearychat_notify_woo_new_order_note_event']) {
        $api->requestWithAttachments(sprintf(__('Order #%d add new Customer Note.', 'bearychat-notify'), $note_data['customer_note']));
    }

}

add_action('woocommerce_low_stock', 'bearychat_notify_low_stock', 10, 1);
add_action('woocommerce_no_stock', 'bearychat_notify_low_stock', 10, 1);
function bearychat_notify_stock_handle($product)
{
    $options = get_option('bearychat_notify_settings');
    $api = new BearyChatAPI();
    if ('instock' === $product->get_stock_status()) {
        if ($options['bearychat_notify_woo_low_stock_event']) {
            $api->request(sprintf(__('%s  stock is low.', 'bearychat-notify'), $product->get_name()));
        }
    } else {
        if ($options['bearychat_notify_woo_no_stock_event']) {
            $api->request(sprintf(__('%s is out of stock', 'bearychat-notify'), $product->get_name()));
        }
    }

}
