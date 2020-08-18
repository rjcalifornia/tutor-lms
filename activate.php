<?php
/**
 * Register the ElggBlog class for the object/blog subtype
 */

if (get_subtype_id('object', 'attachments')) {
	update_subtype('object', 'attachments', 'ElggAttachments');
} else {
	add_subtype('object', 'attachments', 'ElggAttachments');
}

if (get_subtype_id('object', 'assignment_submitted')) {
	update_subtype('object', 'assignment_submitted', 'ElggAssignmentSubmitted');
} else {
	add_subtype('object', 'assignment_submitted', 'ElggAssignmentSubmitted');
}