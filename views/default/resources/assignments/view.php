<?php

$page_type = elgg_extract('page_type', $vars);
$guid = elgg_extract('guid', $vars);

elgg_entity_gatekeeper($guid, 'object', 'assignments');
elgg_group_gatekeeper();

$blog = get_entity($guid);
//$owner_guid = elgg_get_logged_in_user_entity()->guid;

elgg_set_page_owner_guid($blog->container_guid);

// no header or tabs for viewing an individual blog
$params = [
	'filter' => '',
	'title' => $blog->title
];

$container = $blog->getContainerEntity();
$crumbs_title = $container->name;

if (elgg_instanceof($container, 'group')) {
	elgg_push_breadcrumb($crumbs_title, "assignments/group/$container->guid/all");
} else {
	elgg_push_breadcrumb($crumbs_title, "assignments/owner/$container->username");
}

elgg_push_breadcrumb($blog->title);

$params['content'] = elgg_view_entity($blog, array('full_view' => true));

/*
$comments = elgg_get_entities(array(
                            'type' => 'object',
                            'subtype' => 'comment',
                            'container_guid' => $blog->guid,
                            'owner_guid' => $owner_guid,
                         ));*/

//var_dump($comments);
// check to see if we should allow comments
if ($blog->comments_on != 'Off' && $blog->status == 'published') {
    
   /* if (!$comments)
    { */
	$params['content'] .= elgg_view_responses($blog);
 /*   }
    else
    {
       $params['content'] .= elgg_view('resources/assignments/elements/received_assignments');
    }*/
}

$params['sidebar'] = elgg_view('assignments/sidebar', array('page' => $page_type));

$body = elgg_view_layout('content', $params);

echo elgg_view_page($params['title'], $body);
