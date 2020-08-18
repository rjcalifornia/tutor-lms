<?php
/**
 * Elgg remove friend action
 *
 * @package Elgg.Core
 * @subpackage Friends.Management
 */

// Get the GUID of the user to friend
$user_guid = (int) get_input('user');

$user = get_user($user_guid);

$user->role_type = null;
$user->save;
/*
if (!$friend) {
	return elgg_error_response(elgg_echo('error:missing_data'));
}

$user = elgg_get_logged_in_user_entity();
if (!$user->isFriendsWith($friend->guid)) {
	return elgg_ok_response('', elgg_echo('friends:remove:no_friend', [$friend->getDisplayName()]));
}

if (!elgg_get_logged_in_user_entity()->removeFriend($friend->guid)) {
	return elgg_error_response(elgg_echo('friends:remove:failure', [$friend->getDisplayName()]));
}
*/
return elgg_ok_response('', elgg_echo('tutorial:remove:teacher:successful', [$user->getDisplayName()]));
