<?php
/**
 * Group module (also called a group widget)
 *
 * @uses $vars['title']    The title of the module
 * @uses $vars['content']  The module content
 * @uses $vars['all_link'] A link to list content
 * @uses $vars['add_link'] A link to create content
 */

$group = elgg_get_page_owner_entity();

$header = "<span class=\"groups-widget-viewall\">{$vars['all_link']}</span>";
$header .= '<h3>sdasdfad' . $vars['title'] . '</h3>';

if ($group->canEdit() && isset($vars['add_link'])) {
	$vars['content'] .= "<span class='elgg-widget-more'>{$vars['add_link']}</span>";
}
/*
echo '<li>';
echo elgg_view_module('info', '', $vars['content'], array(
	'header' => $header,
	'class' => 'elgg-module-group',
));
echo '</li>';
*/
?>

<div class="col-md-12">
                  <div class="col-md-12 tabs-area">

                    <ul id="tabs-demo2" class="nav nav-tabs nav-tabs-v1" role="tablist">
                      <li role="presentation">
                          <span class="groups-modules"> 
                          <?php echo $vars['title']; ?>
                          </span>
                      </li>
                       
                    </ul>
                    <div id="tabsDemo2Content" class="tab-content tab-content-v1 col-md-12">
                      <div role="tabpanel" class="tab-pane fade active in" id="tabs-demo2-area1" aria-labelledby="tabs-demo2-area1">
                        <p>
                        
                        <?php
                        echo $vars['content'];
                        
                        ?>
                        
                        </p>
                        
                        <p>
                            <span class="groups-widget-viewall">
                            <?php
                              echo  $vars['all_link']
                            ?>
                            </span>
                            
                        </p>
                      </div>
                       
                    </div>

                  </div>
                </div>