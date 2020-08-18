<?php

$page_type = elgg_extract('page_type', $vars);

$params = get_assignments_content_list();

$params['sidebar'] = elgg_view('assignments/sidebar', ['page' => $page_type]);

$body = elgg_view_layout('content', $params);

echo elgg_view_page($params['title'], $body);
