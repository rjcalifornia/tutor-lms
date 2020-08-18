<?php
/**
 * Layout of a river item
 *
 * @uses $vars['item'] ElggRiverItem
 */

$item = $vars['item'];

echo elgg_view('page/components/image_block', array(
	'image' => elgg_view('river/assignments-elements/image', $vars),
	'body' => elgg_view('river/assignments-elements/body', $vars),
	'class' => 'elgg-river-item',
));
