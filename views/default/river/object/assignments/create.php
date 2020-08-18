<?php
/**
 * Blog river view.
 */

$item = $vars['item'];
/* @var ElggRiverItem $item */

$object = $item->getObjectEntity();

$excerpt = $object->excerpt ? $object->excerpt : $object->instructions;
$excerpt = strip_tags($excerpt);
$excerpt = elgg_get_excerpt($excerpt);

echo elgg_view('river/assignments-elements/layout', array(
	'item' => $vars['item'],
	'message' => $excerpt,
));
echo elgg_view('assignments/css');
$group = get_entity($object->container_guid);

$siteUrl = $group->getUrl();
$assignmentUrl = $object->getUrl();

$date_label = elgg_echo('assignments:duedate');
$points_label = elgg_echo('assignments:points');

$cardPreview = 
<<<___HTML
<div class="card article" style="background-color: #556479;     min-width: 200px;
    padding: 40px; color: #464646;
    font-size: 16px;
    position: relative;
    width: auto;
    z-index: 1;">
    <div class="provider">
        <a class="provider-name" href="$siteUrl">
           <span class="head-river-elgg-icon fa fa-group"></span> $group->name
        </a>
    </div>
    </br>
<div class="art-bd">
<center>
<a href="$assignmentUrl">
<span class="assignments-river-elgg-icon fa fa-book"></span>
</a>
</center>
</div>
<div class="txt-bd">
<h2 class="title">
<a  class="url-title" href="$assignmentUrl">
$object->title
</a>
    </h2>
    <p class="assignment-description">
    $object->excerpt
    </p>
      <p class="assignment-description">
    <b><span class="assignments-elgg-icon fa fa-calendar-o"></span> $date_label:</b> $object->duedate
    </p> 
    
   <p class="assignment-description">
    <b><span class="assignments-elgg-icon fa fa-sort-numeric-asc"></span> $points_label:</b> $object->points
    </p>
    
   <a class="action" href="$assignmentUrl">View assignment.. &gt;</a>
        </div>
   
</div>
</br>
___HTML;

echo $cardPreview;