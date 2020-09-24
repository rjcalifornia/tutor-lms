<?php
// get the form inputs
$title = get_input('title');
$body = get_input('instructions');
$points = get_input('points');
$duedate = get_input('duedate');
$duetime = get_input('duetime');
$access_id = get_input('access_id');
$uploaded_files = elgg_get_uploaded_files('featured_image');

$guid = get_input('guid');
$error_forward_url = REFERER;
if ($guid) {
	$entity = get_entity($guid);
	
		$assignments = $entity;
                $assignments->title = $title;
                $assignments->instructions = $body;
                $assignments->points = $points;
                $assignments->duedate = $duedate;
                $assignments->duetime = $duetime;
                $assignments_guid = $assignments->save();
                $message = elgg_echo('assignments:update:success');

	// save some data for revisions once we save the new edit
	
} else {
    
    $message = elgg_echo('assignments:create:success');
//$tags = string_to_tag_array(get_input('tags'));
$excerpt = elgg_get_excerpt($body, 18);
// create a new my_blog object and put the content in it
$assignments = new ElggAssignments();
$assignments->title = $title;
$assignments->instructions = $body;
$assignments->points = $points;
$assignments->duedate = $duedate;
$assignments->duetime = $duetime;
$assignments->excerpt = $excerpt;

// the object can and should have a subtype
$assignments->subtype = 'assignments';
$assignments->comments_on = 'On';
$assignments->status = 'published';

// for now, make all my_blog posts public
$assignments->access_id = $access_id;

// owner is logged in user
$assignments->owner_guid = elgg_get_logged_in_user_guid();
$assignments->container_guid = (int)get_input('container_guid');

if ($uploaded_files) {
$uploaded_file = array_shift($uploaded_files);
if (!$uploaded_file->isValid()) {
        $error = elgg_get_friendly_upload_error($uploaded_file->getError());
        register_error($error);
        forward(REFERER);
}
}

// save to database and get id of the new my_blog
$assignments_guid = $assignments->save();

if($uploaded_file)  
{
$file = new ElggAttachments();
$file->title = $file->getFilename();
$file->owner_guid = $assignments->getGUID();
$file->access_id = 2;

if ($file->acceptUploadedFile($uploaded_file)) {

        $file->save();
              
}
        }

        
        elgg_create_river_item(array(
				'view' => 'river/object/assignments/create',
				'action_type' => 'create',
				'subject_guid' => $assignments->owner_guid,
				'object_guid' => $assignments->getGUID(),
			));

			elgg_trigger_event('publish', 'object', $assignments);
}


if ($assignments_guid) {
   system_message($message);
   forward($assignments->getURL());
} else {
   register_error("The assignment post could not be saved.");
   forward(REFERER); // REFERER is a global variable that defines the previous page
}