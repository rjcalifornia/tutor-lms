<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function get_assignments_content_list($container_guid = NULL) {

	$return = array();
        $page_owner = elgg_get_page_owner_entity()->owner_guid;

	$return['filter_context'] = $container_guid ? 'mine' : 'all';

	$options = array(
		'type' => 'object',
		'subtype' => 'assignments',
		'full_view' => false,
		'no_results' => elgg_echo('assignments:none'),
		'preload_owners' => true,
		'distinct' => false,
	);

	$current_user = elgg_get_logged_in_user_entity();

	if ($container_guid) {
		// access check for closed groups
		elgg_group_gatekeeper();

		$container = get_entity($container_guid);
		if ($container instanceof ElggGroup) {
		$options['container_guid'] = $container_guid;
		} else {
			$options['owner_guid'] = $container_guid;
		}
		$return['title'] = elgg_echo('assignments:title:user_assignments', array($container->name));

		$crumbs_title = $container->name;
		elgg_push_breadcrumb($crumbs_title);

		if ($current_user && ($container_guid == $current_user->guid)) {
			$return['filter_context'] = 'mine';
		} else if (elgg_instanceof($container, 'group')) {
			$return['filter'] = false;
		} else {
			// do not show button or select a tab when viewing someone else's posts
			$return['filter_context'] = 'none';
		}
	} else {
		$options['preload_containers'] = true;
		$return['filter_context'] = 'all';
		$return['title'] = elgg_echo('assignments:title:all_assignments');
		elgg_pop_breadcrumb();
		elgg_push_breadcrumb(elgg_echo('assignments:list'));
	}

        if($page_owner == $current_user->guid)
{
	elgg_register_title_button('assignments', 'add', 'object', 'assignments');
}

	$return['content'] = elgg_list_entities($options);

	return $return;
}


function elgg_view_responses($entity, $add_comment = true, array $vars = array()) {
	if (!($entity instanceof \ElggEntity)) {
		return false;
	}

	$vars['entity'] = $entity;
	$vars['show_add_form'] = $add_comment;
        
        $logged_guid = elgg_get_logged_in_user_entity()->guid;
        $comments = elgg_get_entities(array(
                            'type' => 'object',
                            'subtype' => 'assignment_submitted',
                            'container_guid' => $entity->guid,
                            'owner_guid' => $logged_guid,
                         ));
        
	$vars['class'] = elgg_extract('class', $vars, "{$entity->getSubtype()}-comments");

	$output = elgg_trigger_plugin_hook('comments', $entity->getType(), $vars, false);
	if ($output !== false) {
		return $output;
	} 
        
        if(!$comments){
		return elgg_view('resources/assignments/elements/submissions', $vars);
	}
        
        if($comments && $logged_guid != $entity->owner_guid)
        {
             return elgg_view('resources/assignments/elements/received_notice');
        }
        
        if($logged_guid == $entity->owner_guid){
		return elgg_view('resources/assignments/elements/submissions', $vars);
	}
}


function get_all_responses($attr, $guid, $owner_guid)
{
    
    $logged_user = elgg_get_logged_in_user_entity()->guid;
    
    if($logged_user == $owner_guid)
    {
    $content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'assignment-submitted',
	'container_guid' => $guid,
	'reverse_order_by' => true,
	'full_view' => true,
	//'limit' => $limit,
	'preload_owners' => true,
	'distinct' => false,
	'url_fragment' => $attr['id'],
));

    return $content;
    }
}




function assignments_get_page_content_edit($page, $guid = 0, $revision = NULL) {

	//elgg_require_js('elgg/job-board-manager/save_draft');

	$return = array(
		'filter' => '',
	);

	$vars = array();
	$vars['id'] = 'blog-post-edit';
	$vars['class'] = 'elgg-form-alt';

	$sidebar = '';
	if ($page == 'edit') {
		$jobBoardManager = get_entity((int)$guid);

		$title = elgg_echo('assignments:edit');

		if (elgg_instanceof($jobBoardManager, 'object', 'assignments') && $jobBoardManager->canEdit()) {
			$vars['entity'] = $jobBoardManager;

			$title .= ": \"$jobBoardManager->title\"";

			if ($revision) {
				$revision = elgg_get_annotation_from_id((int)$revision);
				$vars['revision'] = $revision;
				$title .= ' ' . elgg_echo('assignments:edit_revision_notice');

				if (!$revision || !($revision->entity_guid == $guid)) {
					$content = elgg_echo('assignments:error:revision_not_found');
					$return['content'] = $content;
					$return['title'] = $title;
					return $return;
				}
			}

			$body_vars = assignments_prepare_form_vars($jobBoardManager, $revision);

			elgg_push_breadcrumb($jobBoardManager->title, $jobBoardManager->getURL());
			elgg_push_breadcrumb(elgg_echo('edit'));
			
			//elgg_require_js('elgg/job-board-manager/save_draft');

			$content = elgg_view_form('assignments/save', $vars, $body_vars);
			$sidebar = elgg_view('assignments/sidebar/revisions', $vars);
		} else {
			$content = elgg_echo('assignments:error:cannot_edit_post');
		}
	} else {
		elgg_push_breadcrumb(elgg_echo('assignments:add'));
		$body_vars = assignments_prepare_form_vars(null);

		$title = elgg_echo('assignments:add');
		$content = elgg_view_form('assignments/save', $vars, $body_vars);
	}

	$return['title'] = $title;
	$return['content'] = $content;
	$return['sidebar'] = $sidebar;
	return $return;
}

function assignments_prepare_form_vars($jobBoard = NULL, $revision = NULL) {
    
    
	// input names => defaults
	$values = array(
		'title' => NULL,
		'instructions' => NULL,
                'total_openings' => NULL,
                'job_type' => NULL,
                'job_level' => NULL,
                'years_experience' => NULL,
                'salary_type' => NULL,
                'fixed_salary' => NULL,
                'salary_duration' => NULL,
                'salary_currency' => NULL,
                'company_name' => NULL,
                'company_location' => NULL,
                'company_address' => NULL,
                'company_website' => NULL,                            
		'status' => 'published',
		'access_id' => ACCESS_DEFAULT,
		'comments_on' => 'On',
               
		'excerpt' => NULL,
		'tags' => NULL,
		'container_guid' => NULL,
		'guid' => NULL,
		'draft_warning' => '',
	);

	if ($jobBoard) {
		foreach (array_keys($values) as $field) {
			if (isset($jobBoard->$field)) {
				$values[$field] = $jobBoard->$field;
			}
		}

		if ($jobBoard->status == 'draft') {
			$values['access_id'] = $jobBoard->future_access;
		}
	}

	if (elgg_is_sticky_form('job-board-manager')) {
		$sticky_values = elgg_get_sticky_values('job-board-manager');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}
	
	elgg_clear_sticky_form('job-board-manager');

	if (!$jobBoard) {
		return $values;
	}

	

	
	return $values;
}



?>