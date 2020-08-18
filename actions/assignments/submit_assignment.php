<?php
//$ia = elgg_set_ignore_access(true);
//elgg_set_ignore_access(true);

$ia = elgg_set_ignore_access(true);
elgg_set_ignore_access(true);
$assignmentContainer = get_input('assignment_container');
$assignmentSubmitted = elgg_get_uploaded_files('student_assignment');
/*
$assignmentEntity = new ElggAssignmentSubmitted;
$assignmentEntity->owner_guid = elgg_get_logged_in_user_guid();
$assignmentEntity->subtype = 'assignment-submitted';
$assignmentEntity->container_guid = $assignmentContainer;*/

if ($assignmentSubmitted) {
$uploaded_file = array_shift($assignmentSubmitted);
if (!$uploaded_file->isValid()) {
        $error = elgg_get_friendly_upload_error($uploaded_file->getError());
        register_error($error);
        forward(REFERER);
}
}


//$assignmentEntity->save();

if($uploaded_file)  
{
$file = new ElggAssignmentSubmitted;
$file->title = $file->getFilename();
$file->category = "Submissions";

$file->owner_guid = elgg_get_logged_in_user_guid();
$file->container_guid = $assignmentContainer;
$file->access_id = 2;

if ($file->acceptUploadedFile($uploaded_file)) {
        //$guid = $file->save(); 
        $file->save();
        
          
}
        }
system_message("Your assignment was successfully submitted.");
forward(REFERER); 