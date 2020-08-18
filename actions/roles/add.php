<?php
/**
 * Elgg add friend action
 *
 * @package Elgg.Core
 * @subpackage Friends.Management
 */

// Get the GUID of the user to friend
$user_guid = (int) get_input('user');

$user = get_user($user_guid);

$user->role_type = 'teacher';
$user->save;
/*
if (!$friend) {
	return elgg_error_response(elgg_echo('error:missing_data'));
}

$user = elgg_get_logged_in_user_entity();
if ($user->isFriendsWith($friend->guid)) {
	return elgg_ok_response('', elgg_echo('friends:add:duplicate', [$friend->getDisplayName()]));
}

if (!elgg_get_logged_in_user_entity()->addFriend($friend->guid, true)) {
	return elgg_error_response(elgg_echo('friends:add:failure', [$friend->getDisplayName()]));
}
*/
return elgg_ok_response('', elgg_echo('tutorial:add:teacher:successful', [$user->getDisplayName()]));
