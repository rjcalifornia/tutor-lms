<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$site_url = elgg_get_site_url();
$page_owner = elgg_get_page_owner_entity()->owner_guid;
$current_user = elgg_get_logged_in_user_entity();

elgg_gatekeeper();
$form_vars = array('enctype' => 'multipart/form-data');
$vars = array();
	$vars['id'] = 'blog-post-edit';
	$vars['class'] = 'elgg-form-alt';
        $vars['enctype'] = 'multipart/form-data';
        

$title = elgg_echo('assignments:add');

$content = elgg_view_title($title);

// add the form to the main column
$content .= elgg_view_form("assignments/save", $form_vars, $vars, $body_vars);

// optionally, add the content for the sidebar
$sidebar = "";

// layout the page
$body = elgg_view_layout('one_sidebar', array(
   'content' => $content,
   'sidebar' => $sidebar
));

     if($page_owner == $current_user->guid)
{
// draw the page, including the HTML wrapper and basic page layout
echo elgg_view_page($title, $body);
}
else
{
     register_error("You are not allowed to perform that action");
   forward(REFERER);
}
//echo $content;
?>
<!-- Compiled and minified CSS -->
