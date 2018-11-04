<?php

include_once 'section-handle.php';
include_once 'system-handle.php';
include_once 'post-handle.php';
include_once 'page-handle.php';
include_once 'comments-handle.php';
include_once 'user-handle.php';
include_once 'woo-handle.php';

add_action('admin_menu', 'bearychat_notify_add_admin_menu');
add_action('admin_init', 'bearychat_notify_settings_init');

function bearychat_notify_add_admin_menu()
{

    add_options_page(__('Bearychat Notification', 'bearychat-notify'), __('Bearychat Notification', 'bearychat-notify'), 'manage_options', 'bearychat_notification', 'bearychat_notify_options_page');

}

function bearychat_notify_settings_init()
{

    register_setting('bearychat_notification_page', 'bearychat_notify_settings');

    /**
     * Basic Section
     */
    add_settings_section(
        'bearychat_notify_basic_settings_section',
        __('Plugin Basic Settings', 'bearychat-notify'),
        'bearychat_notify_settings_section_callback',
        'bearychat_notification_page'
    );

    add_settings_field(
        'bearychat_notify_webhook_url',
        __('BearyChat WebHook URL', 'bearychat-notify'),
        'bearychat_notify_webhook_url_render',
        'bearychat_notification_page',
        'bearychat_notify_basic_settings_section'
    );

    /**
     * Event Section
     */
    add_settings_section(
        'bearychat_notify_event_section',
        __('Event Settings', 'bearychat-notify'),
        'bearychat_notify_event_section_callback',
        'bearychat_notification_page'
    );

    add_settings_section(
        'bearychat_notify_system_event_section',
        __('System Event', 'bearychat-notify'),
        'bearychat_notify_system_event_section_callback',
        'bearychat_notification_page'
    );

    add_settings_section(
        'bearychat_notify_post_event_section',
        __('Post Event', 'bearychat-notify'),
        'bearychat_notify_post_event_section_callback',
        'bearychat_notification_page'
    );
    add_settings_section(
        'bearychat_notify_page_event_section',
        __('Page Event', 'bearychat-notify'),
        'bearychat_notify_page_event_section_callback',
        'bearychat_notification_page'
    );
    add_settings_section(
        'bearychat_notify_comment_event_section',
        __('Comment Event', 'bearychat-notify'),
        'bearychat_notify_comment_event_section_callback',
        'bearychat_notification_page'
    );
    add_settings_section(
        'bearychat_notify_user_event_section',
        __('User Event', 'bearychat-notify'),
        'bearychat_notify_user_event_section_callback',
        'bearychat_notification_page'
    );
    add_settings_section(
        'bearychat_notify_woocommerce_event_section',
        __('Woocommerce Event', 'bearychat-notify'),
        'bearychat_notify_woocommerce_event_section_callback',
        'bearychat_notification_page'
    );

    /**
     * System Event
     */
    add_settings_field(
        'bearychat_notify_wordpress_update_event',
        __('WordPress has update', 'bearychat-notify'),
        'bearychat_notify_wordpress_update_event_render',
        'bearychat_notification_page',
        'bearychat_notify_system_event_section'
    );

    /**
     * Post Event
     */
    add_settings_field(
        'bearychat_notify_post_publish_event',
        __('New Post Publish', 'bearychat-notify'),
        'bearychat_notify_post_publish_event_render',
        'bearychat_notification_page',
        'bearychat_notify_post_event_section'
    );
    add_settings_field(
        'bearychat_notify_post_future_event',
        __('New Post Scheduled', 'bearychat-notify'),
        'bearychat_notify_post_future_event_render',
        'bearychat_notification_page',
        'bearychat_notify_post_event_section'
    );
    add_settings_field(
        'bearychat_notify_post_pending_event',
        __('New Post Pending', 'bearychat-notify'),
        'bearychat_notify_post_pending_event_render',
        'bearychat_notification_page',
        'bearychat_notify_post_event_section'
    );
    add_settings_field(
        'bearychat_notify_post_updated_event',
        __('New Post Updated', 'bearychat-notify'),
        'bearychat_notify_post_updated_event_render',
        'bearychat_notification_page',
        'bearychat_notify_post_event_section'
    );
    add_settings_field(
        'bearychat_notify_post_trashed_event',
        __('New Post Trashed', 'bearychat-notify'),
        'bearychat_notify_post_trashed_event_render',
        'bearychat_notification_page',
        'bearychat_notify_post_event_section'
    );

    /**
     * Page Event
     */
    add_settings_field(
        'bearychat_notify_page_publish_event',
        __('New Page Publish', 'bearychat-notify'),
        'bearychat_notify_page_publish_event_render',
        'bearychat_notification_page',
        'bearychat_notify_page_event_section'
    );
    add_settings_field(
        'bearychat_notify_page_future_event',
        __('New Page Scheduled', 'bearychat-notify'),
        'bearychat_notify_page_future_event_render',
        'bearychat_notification_page',
        'bearychat_notify_page_event_section'
    );
    add_settings_field(
        'bearychat_notify_page_pending_event',
        __('New Page Pending', 'bearychat-notify'),
        'bearychat_notify_page_pending_event_render',
        'bearychat_notification_page',
        'bearychat_notify_page_event_section'
    );
    add_settings_field(
        'bearychat_notify_page_updated_event',
        __('New Page Updated', 'bearychat-notify'),
        'bearychat_notify_page_updated_event_render',
        'bearychat_notification_page',
        'bearychat_notify_page_event_section'
    );
    add_settings_field(
        'bearychat_notify_page_trashed_event',
        __('New Page Trashed', 'bearychat-notify'),
        'bearychat_notify_page_trashed_event_render',
        'bearychat_notification_page',
        'bearychat_notify_page_event_section'
    );
    /**
     * Comment Event
     */
    add_settings_field(
        'bearychat_notify_new_comment_event',
        __('New Comment', 'bearychat-notify'),
        'bearychat_notify_new_comment_event_render',
        'bearychat_notification_page',
        'bearychat_notify_comment_event_section'
    );
    /**
     * User Event
     */
    add_settings_field(
        'bearychat_notify_user_reg_event',
        __('User Registered', 'bearychat-notify'),
        'bearychat_notify_user_reg_event_render',
        'bearychat_notification_page',
        'bearychat_notify_user_event_section'
    );

    add_settings_field(
        'bearychat_notify_admin_login_event',
        __('Administrator Logged In', 'bearychat-notify'),
        'bearychat_notify_admin_login_event_render',
        'bearychat_notification_page',
        'bearychat_notify_user_event_section'
    );

    add_settings_field(
        'bearychat_notify_admin_failed_login_event',
        __('Administrator Failed Login', 'bearychat-notify'),
        'bearychat_notify_admin_failed_login_event_render',
        'bearychat_notification_page',
        'bearychat_notify_user_event_section'
    );
    /**
     * Woocommerce Event
     */
    add_settings_field(
        'bearychat_notify_woo_new_order_event',
        __('New Order', 'bearychat-notify'),
        'bearychat_notify_woo_new_order_event_render',
        'bearychat_notification_page',
        'bearychat_notify_woocommerce_event_section'
    );
    add_settings_field(
        'bearychat_notify_woo_order_completed_event',
        __('Order Completed', 'bearychat-notify'),
        'bearychat_notify_woo_order_completed_event_render',
        'bearychat_notification_page',
        'bearychat_notify_woocommerce_event_section'
    );
    add_settings_field(
        'bearychat_notify_woo_order_pending_event',
        __('Order Pending', 'bearychat-notify'),
        'bearychat_notify_woo_order_pending_event_render',
        'bearychat_notification_page',
        'bearychat_notify_woocommerce_event_section'
    );
    add_settings_field(
        'bearychat_notify_woo_order_processing_event',
        __('Order Processing', 'bearychat-notify'),
        'bearychat_notify_woo_order_processing_event_render',
        'bearychat_notification_page',
        'bearychat_notify_woocommerce_event_section'
    );

    add_settings_field(
        'bearychat_notify_woo_order_on_hold_event',
        __('Order On Hold', 'bearychat-notify'),
        'bearychat_notify_woo_order_on_hold_event_render',
        'bearychat_notification_page',
        'bearychat_notify_woocommerce_event_section'
    );
    add_settings_field(
        'bearychat_notify_woo_order_cancelled_event',
        __('Order Cancelled', 'bearychat-notify'),
        'bearychat_notify_woo_order_cancelled_event_render',
        'bearychat_notification_page',
        'bearychat_notify_woocommerce_event_section'
    );

    add_settings_field(
        'bearychat_notify_woo_order_refunded_event',
        __('Order Refunded', 'bearychat-notify'),
        'bearychat_notify_woo_order_refunded_event_render',
        'bearychat_notification_page',
        'bearychat_notify_woocommerce_event_section'
    );

    add_settings_field(
        'bearychat_notify_woo_order_failed_event',
        __('Order Failed', 'bearychat-notify'),
        'bearychat_notify_woo_order_failed_event_render',
        'bearychat_notification_page',
        'bearychat_notify_woocommerce_event_section'
    );
    add_settings_field(
        'bearychat_notify_woo_new_order_note_event',
        __('New Order Note', 'bearychat-notify'),
        'bearychat_notify_woo_new_order_note_event_render',
        'bearychat_notification_page',
        'bearychat_notify_woocommerce_event_section'
    );

    add_settings_field(
        'bearychat_notify_woo_low_stock_event',
        __('Product Low Stock', 'bearychat-notify'),
        'bearychat_notify_woo_low_stock_event_render',
        'bearychat_notification_page',
        'bearychat_notify_woocommerce_event_section'
    );

    add_settings_field(
        'bearychat_notify_woo_no_stock_event',
        __('Product Out of Stock', 'bearychat-notify'),
        'bearychat_notify_woo_no_stock_event_render',
        'bearychat_notification_page',
        'bearychat_notify_woocommerce_event_section'
    );

}
