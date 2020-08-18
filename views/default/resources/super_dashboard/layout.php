<?php

// Ensure that only logged-in users can see this page
elgg_gatekeeper();

// Set context and title
elgg_set_context('dashboard');
elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());
$title = elgg_echo('dashboard');

// wrap intro message in a div
//$intro_message = elgg_view('dashboard/blurb');

//  echo elgg_view('super_dashboard/css');


$body = elgg_view('resources/super_dashboard/elements/dashboard');

echo elgg_view_page($title, $body);