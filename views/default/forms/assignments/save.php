<?php

$assignments = get_entity($vars['guid']);
$vars['entity'] = $blog;

 
echo elgg_view_field([
    '#type' => 'text',
    '#label' => elgg_echo('assignments:title'),
    'name' => 'title',
    'value' => $vars['title'],
    'required' => true,
]);
 

echo elgg_view_field([
    '#type' => 'longtext',
    '#label' => elgg_echo('assignments:instructions'),
    'name' => 'instructions',
    'value' => $vars['instructions'],
    'required' => true,
]);

echo elgg_view_field([
    '#type' => 'text',
    '#label' => elgg_echo('assignments:points'),
    'name' => 'points',
    'value' => $assignments->points,
    'required' => true,
]);

echo elgg_view_field([
    '#type' => 'date',
    '#label' => elgg_echo('assignments:date'),
    'name' => 'duedate',
    'value' => $assignments->duedate,
    'required' => true,
]);

echo elgg_view_field([
    '#type' => 'select',
    '#label' => elgg_echo('assignments:time'),
    'name' => 'duetime',
    'options_values' => array(
                
		'07:30' => '07:30',
                '08:30' => '08:30',
                '09:30' => '09:30',
                '10:30' => '10:30',
                '11:30' => '11:30',
                '12:30' => '12:30',
                '13:30' => '13:30',
		'14:30' => '14:30',
                '15:30' => '15:30',
                '16:30' => '16:30',
                '17:30' => '17:30',
                '18:30' => '18:30',
                '19:30' => '19:30',
                '20:30' => '20:30',
                '21:30' => '21:30',
                '22:30' => '22:30',
                '23:30' => '23:30',
                '00:30' => '00:30',
        
	),
    'required' => true,
    'value' => $assignments->duetime,
]); 

echo elgg_view_field([
        '#type' => 'file',
    '#label' => elgg_echo('assignments:file'),
        'name' => 'featured_image',
        'label' => 'Select an image to upload',
        'help' => 'Only jpeg, gif and png images are supported',
]);

echo elgg_view_field([
        '#type' => 'access',
        '#label' => 'Access',
	'name' => 'access_id',
	
	'value' => $vars['access_id'],
	'entity' => $vars['entity'],
	'entity_type' => 'object',
	'entity_subtype' => 'assignments',
]);

$container_guid_input = elgg_view('input/hidden', array('name' => 'container_guid', 'value' => elgg_get_page_owner_guid()));
$guid_input = elgg_view('input/hidden', array('name' => 'guid', 'value' => $vars['guid']));

echo $container_guid_input;
echo $guid_input;

$submit = elgg_view_field(array(
    '#type' => 'submit',
    '#class' => 'elgg-foot',
    'value' => elgg_echo('save'),
));
elgg_set_form_footer($submit);