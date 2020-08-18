<?php
/**
 * Blog sidebar
 *
 * @package Blog
 */

$page = elgg_extract('page', $vars);

// fetch & display latest comments
if ($page != 'friends') {
	echo elgg_view('page/elements/comments_block', array(
		'subtypes' => 'blog',
		'container_guid' => elgg_get_page_owner_guid(),
	));
}

if (in_array($page, ['owner', 'assignments', 'archive'])) {
	echo elgg_view('assignments/sidebar/archives', $vars);
}

if ($page != 'friends') {
	echo elgg_view('page/elements/tagcloud_block', array(
		'subtypes' => 'assignments',
		'container_guid' => elgg_get_page_owner_guid(),
	));
}
