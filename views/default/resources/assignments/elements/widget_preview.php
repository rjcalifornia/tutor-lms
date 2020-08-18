<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
echo elgg_view('assignments/css');
$object = $vars['assignment'];
$group = elgg_get_page_owner_entity();

$siteUrl = $group->getUrl();
$assignmentUrl = $object->getUrl();

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
<span class="assignments-river-elgg-icon fa fa-pencil-square-o"></span>
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
    </p><a class="action" href="$assignmentUrl">View assignment.. &gt;</a>
        </div>
   
</div>
</br>
___HTML;

echo $cardPreview;
?>
