<?php 

function bearychat_notify_new_comment_event_render(){
	$options = get_option('bearychat_notify_settings');
?>
	<input type='checkbox' name='bearychat_notify_settings[bearychat_notify_new_comment_event]' <?php checked($options['bearychat_notify_new_comment_event'], 1);?> value='1'>
	<?php
}