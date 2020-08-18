<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
</br>
<h1 class="elgg-listing-summary-title">
<?php 
echo elgg_echo('assignments:submit:homework');

?>
</h1>

<?php


$container = $vars['entity']->guid;


$assignment_label = elgg_echo('assignments:student:submit');
$assignment_input = elgg_view('input/file', array(
	'name' => 'student_assignment',
	'label' => 'Select a file to upload',
        'required' => true,
	
));


$hidden_container = elgg_view('input/text', array(
	'name' => 'assignment_container',
	'id' => 'assignment_container',
        'hidden' => true,
	'value' => $container
));

$save_button = elgg_view('input/submit', array(
	'value' => elgg_echo('save'),
	'name' => 'save',
));


echo <<<___HTML
 
   
<div>
</br>


<div>
	<label for="job_title">$assignment_label</label>
	$assignment_input
</div>
</br>

$hidden_container
___HTML;

$footer = <<<___HTML

$save_button
    </div>
</br>
___HTML;

elgg_set_form_footer($footer);


?>
