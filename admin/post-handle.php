<?php
function bearychat_notify_post_publish_event_render()
{

    $options = get_option('bearychat_notify_settings');
    ?>
	<input type='checkbox' name='bearychat_notify_settings[bearychat_notify_post_publish_event]' <?php checked($options['bearychat_notify_post_publish_event'], 1);?> value='1'>
	<?php

}

function bearychat_notify_post_future_event_render()
{
    $options = get_option('bearychat_notify_settings');
    ?>
	<input type='checkbox' name='bearychat_notify_settings[bearychat_notify_post_future_event]' <?php checked($options['bearychat_notify_post_future_event'], 1);?> value='1'>
	<?php
}

function bearychat_notify_post_pending_event_render()
{
    $options = get_option('bearychat_notify_settings');
    ?>
    <input type='checkbox' name='bearychat_notify_settings[bearychat_notify_post_pending_event]' <?php checked($options['bearychat_notify_post_pending_event'], 1);?> value='1'>
    <?php
}

function bearychat_notify_post_updated_event_render()
{
    $options = get_option('bearychat_notify_settings');
    ?>
    <input type='checkbox' name='bearychat_notify_settings[bearychat_notify_post_updated_event]' <?php checked($options['bearychat_notify_post_updated_event'], 1);?> value='1'>
    <?php
}
function bearychat_notify_post_trashed_event_render()
{
    $options = get_option('bearychat_notify_settings');
    ?>
    <input type='checkbox' name='bearychat_notify_settings[bearychat_notify_post_trashed_event]' <?php checked($options['bearychat_notify_post_trashed_event'], 1);?> value='1'>
    <?php
}