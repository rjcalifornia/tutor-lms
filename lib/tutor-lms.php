<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function tutor_list_river(array $options = array()) {
	elgg_register_rss_link();

	$defaults = array(
		'offset'     => (int) max(get_input('offset', 0), 0),
		'limit'      => (int) max(get_input('limit', max(20, elgg_get_config('default_limit'))), 0),
		'pagination' => true,
		'list_class' => 'elgg-list-river',
		'no_results' => '',
	);

	$options = array_merge($defaults, $options);

	if (!$options["limit"] && !$options["offset"]) {
		// no need for pagination if listing is unlimited
		$options["pagination"] = false;
	}
	
	$options['count'] = false;
	$items = elgg_get_river($options);
	$options['count'] = is_array($items) ? count($items) : 0;
	
	if (!empty($items)) {
		$count_needed = true;
		if (!$options['pagination']) {
			$count_needed = false;
		} elseif (!$options['offset'] && !$options['limit']) {
			$count_needed = false;
		} elseif (($options['count'] < (int) $options['limit']) && !$options['offset']) {
			$count_needed = false;
		}
		
		if ($count_needed) {
			$options['count'] = true;
		
			$options['count'] = (int) elgg_get_river($options);
		}
	}
	
	$options['items'] = $items;
      //  var_dump($options['items']);
        if(count($options['items']) > 1){
	$result = elgg_view('tutor_lms_theme/elements/list_river', $options);
        }
        else{
            $result = null;
        }
        
        return $result;
}

function tutor_user_courses($user, $dbprefix){
    

if($user->role_type != 'teacher'){
$userGroups = elgg_get_entities_from_relationship(array(
	'type' => 'group',
	'relationship' => 'member',
	'relationship_guid' => $user->guid,
	'inverse_relationship' => false,
	'full_view' => false,
	'joins' => array("JOIN {$dbprefix}groups_entity ge ON e.guid = ge.guid"),
	'order_by' => 'ge.name ASC',
	'no_results' => elgg_echo('groups:none'),
));
}

if($user->role_type == 'teacher'){
$userGroups = elgg_get_entities_from_relationship(array(
	'type' => 'group',
	//'relationship' => 'owner',
    'owner_guid' => $user->guid,
	//'relationship_guid' => $user->guid,
	'inverse_relationship' => false,
	'full_view' => false,
	'joins' => array("JOIN {$dbprefix}groups_entity ge ON e.guid = ge.guid"),
	'order_by' => 'ge.name ASC',
	'no_results' => elgg_echo('groups:none'),
));
}

return $userGroups;
}

function tutor_courses_activities($userGroups, $dbprefix){
    foreach ($userGroups as $group) {

   $group_guids[] = $group->guid;
    
   
  }
   $guids_in = implode(',', array_unique(array_filter($group_guids)));
   
   $activity = elgg_list_river([
	'limit' => 8,
	'pagination' => false,
	'joins' => ["JOIN {$dbprefix}entities e1 ON e1.guid = rv.object_guid"],
	'wheres' => ["(e1.container_guid IN ({$guids_in}))"],
]);
   
   return $activity;
}
