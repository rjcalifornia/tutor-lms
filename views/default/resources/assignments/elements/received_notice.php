<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$assignment_received = elgg_echo('assignments:received');

$body = <<<___HTML
   
      <label for="assignment_points" class="assignments_labels">$assignment_received</label>
    <div class="assignments_fields">
    
       
            
       
    </div>

___HTML;

echo elgg_view('object/elements/full', array(
        'body' => $body,
        ));
