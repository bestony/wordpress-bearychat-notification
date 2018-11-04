<?php
function bearychat_notify_woo_new_order_event_render()
{
    $options = get_option('bearychat_notify_settings');
    ?>
	<input type='checkbox' name='bearychat_notify_settings[bearychat_notify_woo_new_order_event]' <?php checked($options['bearychat_notify_woo_new_order_event'], 1);?> value='1'>
	<?php
}
function bearychat_notify_woo_order_completed_event_render()
{
    $options = get_option('bearychat_notify_settings');
    ?>
	<input type='checkbox' name='bearychat_notify_settings[bearychat_notify_woo_order_completed_event]' <?php checked($options['bearychat_notify_woo_order_completed_event'], 1);?> value='1'>
	<?php
}
function bearychat_notify_woo_order_pending_event_render()
{
    $options = get_option('bearychat_notify_settings');
    ?>
	<input type='checkbox' name='bearychat_notify_settings[bearychat_notify_woo_order_pending_event]' <?php checked($options['bearychat_notify_woo_order_pending_event'], 1);?> value='1'>
	<?php
}
function bearychat_notify_woo_order_processing_event_render()
{
    $options = get_option('bearychat_notify_settings');
    ?>
	<input type='checkbox' name='bearychat_notify_settings[bearychat_notify_woo_order_processing_event]' <?php checked($options['bearychat_notify_woo_order_processing_event'], 1);?> value='1'>
	<?php
}
function bearychat_notify_woo_order_on_hold_event_render()
{
    $options = get_option('bearychat_notify_settings');
    ?>
	<input type='checkbox' name='bearychat_notify_settings[bearychat_notify_woo_order_on_hold_event]' <?php checked($options['bearychat_notify_woo_order_on_hold_event'], 1);?> value='1'>
	<?php
}
function bearychat_notify_woo_order_cancelled_event_render()
{
    $options = get_option('bearychat_notify_settings');
    ?>
	<input type='checkbox' name='bearychat_notify_settings[bearychat_notify_woo_order_cancelled_event]' <?php checked($options['bearychat_notify_woo_order_cancelled_event'], 1);?> value='1'>
	<?php
}
function bearychat_notify_woo_order_refunded_event_render()
{
    $options = get_option('bearychat_notify_settings');
    ?>
	<input type='checkbox' name='bearychat_notify_settings[bearychat_notify_woo_order_refunded_event]' <?php checked($options['bearychat_notify_woo_order_refunded_event'], 1);?> value='1'>
	<?php
}
function bearychat_notify_woo_order_failed_event_render()
{
    $options = get_option('bearychat_notify_settings');
    ?>
	<input type='checkbox' name='bearychat_notify_settings[bearychat_notify_woo_order_failed_event]' <?php checked($options['bearychat_notify_woo_order_failed_event'], 1);?> value='1'>
	<?php
}
function bearychat_notify_woo_new_order_note_event_render()
{
    $options = get_option('bearychat_notify_settings');
    ?>
	<input type='checkbox' name='bearychat_notify_settings[bearychat_notify_woo_new_order_note_event]' <?php checked($options['bearychat_notify_woo_new_order_note_event'], 1);?> value='1'>
	<?php
}
function bearychat_notify_woo_low_stock_event_render()
{
    $options = get_option('bearychat_notify_settings');
    ?>
	<input type='checkbox' name='bearychat_notify_settings[bearychat_notify_woo_low_stock_event]' <?php checked($options['bearychat_notify_woo_low_stock_event'], 1);?> value='1'>
	<?php
}
function bearychat_notify_woo_no_stock_event_render()
{
    $options = get_option('bearychat_notify_settings');
    ?>
	<input type='checkbox' name='bearychat_notify_settings[bearychat_notify_woo_no_stock_event]' <?php checked($options['bearychat_notify_woo_no_stock_event'], 1);?> value='1'>
	<?php
}