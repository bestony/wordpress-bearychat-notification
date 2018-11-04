<?php
/**
 * 选项渲染函数
 */
function bearychat_notify_webhook_url_render()
{

    $options = get_option('bearychat_notify_settings');
    ?>
	<input type='text' name='bearychat_notify_settings[bearychat_notify_webhook_url]' value='<?php echo $options['bearychat_notify_webhook_url']; ?>'>
	<p class="description">Bearychat InComing Webhook URL</p>
	<?php

}

/**
 * 页面构造
 */
function bearychat_notify_settings_section_callback()
{

    echo __('Setting Webhook URL', 'bearychat-notify');

}
function bearychat_notify_event_section_callback()
{

    echo __('Enable Event You Need', 'bearychat-notify');

}
function bearychat_notify_post_event_section_callback(){
	// echo __('Post Event', 'bearychat-notify');
}
function bearychat_notify_page_event_section_callback()
{
    // echo __('Page Event', 'bearychat-notify');
}

function bearychat_notify_comment_event_section_callback()
{
    // echo __('Comment Event', 'bearychat-notify');
}
function bearychat_notify_system_event_section_callback(){
	// echo __('System Event', 'bearychat-notify');
}
function bearychat_notify_user_event_section_callback(){
	// echo __('User Event', 'bearychat-notify');

}
function bearychat_notify_woocommerce_event_section_callback(){
	// echo __('WooCommerce Event', 'bearychat-notify');
}
function bearychat_notify_options_page()
{

    ?>
	<form action='options.php' method='post'>

		<h2>Bearychat Notification</h2>

		<?php
settings_fields('bearychat_notification_page');
    do_settings_sections('bearychat_notification_page');
    submit_button();
    ?>

	</form>
	<?php

}