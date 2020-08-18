<?php
/**
 * Edit blog form
 *
 * @package Blog
 */

/*$assignment = get_entity($vars['guid']);
$vars['entity'] = $assignment;

$draft_warning = $vars['draft_warning'];
if ($draft_warning) {
	$draft_warning = '<span class="mbm elgg-text-help">' . $draft_warning . '</span>';
}

$action_buttons = '';
$delete_link = '';
$preview_button = '';

if ($vars['guid']) {
	// add a delete button if editing
	$delete_url = "action/assignments/delete?guid={$vars['guid']}";
	$delete_link = elgg_view('output/url', array(
		'href' => $delete_url,
		'text' => elgg_echo('delete'),
		'class' => 'elgg-button elgg-button-delete float-alt',
		'confirm' => true,
	));
}

// published assignments do not get the preview button
if (!$vars['guid'] || ($assignment && $assignment->status != 'published')) {
	$preview_button = elgg_view('input/submit', array(
		'value' => elgg_echo('preview'),
		'name' => 'preview',
		'class' => 'elgg-button-submit mls',
	));
}

$save_button = elgg_view('input/submit', array(
	'value' => elgg_echo('save'),
	'name' => 'save',
));
$action_buttons = $save_button . $preview_button . $delete_link;

$title_label = elgg_echo('title');
$title_input = elgg_view('input/text', array(
	'name' => 'title',
	'id' => 'assignments_title',
	'value' => $vars['title']
));

 

$body_label = elgg_echo('assignments:description');
$body_input = elgg_view('input/longtext', array(
	'name' => 'instructions',
	'id' => 'assignments_instructions',
	'value' => $vars['instructions']
));


$points_label = elgg_echo('assignments:point');
$points_input = elgg_view('input/text', array(
	'name' => 'points',
	'id' => 'assignments_points',
	'value' => $vars['points']
));


$date_label = elgg_echo('assignments:duedate');
$date_input = elgg_view('input/date', array(
	'name' => 'duedate',
	'id' => 'assignments_duedate',
	'value' => $vars['duedate']
));

$save_status = elgg_echo('elggpress:save_status');
if ($vars['guid']) {
	$entity = get_entity($vars['guid']);
	$saved = date('F j, Y @ H:i', $entity->time_created);
} else {
	$saved = elgg_echo('never');
}

$status_label = elgg_echo('status');
$status_input = elgg_view('input/select', array(
	'name' => 'status',
	'id' => 'blog_status',
	'value' => $vars['status'],
	'options_values' => array(
		'draft' => elgg_echo('status:draft'),
		'published' => elgg_echo('status:published')
	)
));

$comments_label = elgg_echo('comments');
$comments_input = elgg_view('input/select', array(
	'name' => 'comments_on',
	'id' => 'blog_comments_on',
	'value' => $vars['comments_on'],
	'options_values' => array('On' => elgg_echo('on'), 'Off' => elgg_echo('off'))
));

 

/**
Input for uploading an image. Nothing else needs to be done since most of the things are 
being handled by elgg
 **/

 
/*

$access_label = elgg_echo('access');
$access_input = elgg_view('input/access', array(
	'name' => 'access_id',
	'id' => 'assignments_access_id',
	'value' => $vars['access_id'],
	'entity' => $vars['entity'],
	'entity_type' => 'object',
	'entity_subtype' => 'assignments',
));



// hidden inputs
$container_guid_input = elgg_view('input/hidden', array('name' => 'container_guid', 'value' => elgg_get_page_owner_guid()));
$guid_input = elgg_view('input/hidden', array('name' => 'guid', 'value' => $vars['guid']));


echo <<<___HTML

$draft_warning

<div>
	<label for="blog_title">$title_label</label>
	$title_input
</div>

<div>
	<label for="blog_excerpt">$excerpt_label</label>
	$excerpt_input
</div>
      $current_label
      $current_featured  
        <div>
	<label for="featured_image">$featured_label</label>
	$featured_image
</div>

<div>
	<label for="blog_description">$body_label</label>
	$body_input
</div>

<div>
	<label for="blog_tags">$points_label</label>
	$points_input
</div>

<div>
	<label for="blog_tags">$date_label</label>
	$date_input
</div>

<div>
	<label for="blog_comments_on">$comments_label</label>
	$comments_input
</div>

<div>
	<label for="blog_access_id">$access_label</label>
	$access_input
</div>

<div>
	<label for="blog_status">$status_label</label>
	$status_input
</div>

$guid_input
$container_guid_input

___HTML;

$footer = <<<___HTML
<div class="elgg-subtext mbm">
	$save_status <span class="blog-save-status-time">$saved</span>
</div>
$action_buttons
___HTML;

elgg_set_form_footer($footer);*/
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
    'value' => $vars['points'],
    'required' => true,
]);

echo elgg_view_field([
    '#type' => 'date',
    '#label' => elgg_echo('assignments:date'),
    'name' => 'duedate',
    'value' => $vars['duedate'],
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
    'value' => $vars['duetime'],
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