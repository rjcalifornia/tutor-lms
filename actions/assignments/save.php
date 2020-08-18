<?php
// get the form inputs
$title = get_input('title');
$body = get_input('instructions');
$points = get_input('points');
$duedate = get_input('duedate');
$duetime = get_input('duetime');
$access_id = get_input('access_id');
$uploaded_files = elgg_get_uploaded_files('featured_image');

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
//$file->subtype = "attachments";
//$file->category = "featured";
$file->owner_guid = $assignments->getGUID();
$file->access_id = 2;
//$file->thumbnail = $file->getIcon('small')->getFilename();
//$file->smallthumb = $file->getIcon('medium')->getFilename();
//$file->largethumb = $file->getIcon('large')->getFilename();
if ($file->acceptUploadedFile($uploaded_file)) {
        //$guid = $file->save(); 
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
// if the my_blog was saved, we want to display the new post
// otherwise, we want to register an error and forward back to the form
if ($assignments_guid) {
   system_message("Your assignment was published.");
   forward($assignments->getURL());
} else {
   register_error("The assignment post could not be saved.");
   forward(REFERER); // REFERER is a global variable that defines the previous page
}