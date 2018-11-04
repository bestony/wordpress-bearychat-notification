<?php
function bearychat_notify_user_reg_event_render()
{
    $options = get_option('bearychat_notify_settings');
    ?>
	<input type='checkbox' name='bearychat_notify_settings[bearychat_notify_user_reg_event]' <?php checked($options['bearychat_notify_user_reg_event'], 1);?> value='1'>
	<?php
}
function bearychat_notify_admin_login_event_render()
{
    $options = get_option('bearychat_notify_settings');
    ?>
	<input type='checkbox' name='bearychat_notify_settings[bearychat_notify_admin_login_event]' <?php checked($options['bearychat_notify_admin_login_event'], 1);?> value='1'>
	<?php
}

function bearychat_notify_admin_failed_login_event_render()
{
    $options = get_option('bearychat_notify_settings');
    ?>
	<input type='checkbox' name='bearychat_notify_settings[bearychat_notify_admin_failed_login_event]' <?php checked($options['bearychat_notify_admin_failed_login_event'], 1);?> value='1'>
	<?php
}
