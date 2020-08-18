<?php
/**
 * Message for non-members on closed membership group profile pages.
 * 
 * @package ElggGroups
 */

?>
<div class="col-md-12">
                  <div class="col-md-12 tabs-area">
                      <ul id="tabs-demo2" class="nav nav-tabs nav-tabs-v1" role="tablist">
                      <li role="presentation">
                          <span class="groups-modules"> 
                          <?php echo elgg_echo('tutor-lms:course:notice'); ?>
                          </span>
                      </li>
                       
                    </ul>
                    <div id="tabsDemo2Content" class="tab-content tab-content-v1 col-md-12">
                      <div role="tabpanel" class="tab-pane fade active in" id="tabs-demo2-area1" aria-labelledby="tabs-demo2-area1">
                       <p class="mtm">
                        <?php
                            echo elgg_echo('groups:closedgroup');
                            if (elgg_is_logged_in()) {
                                    echo ' ' . elgg_echo('groups:closedgroup:request');
                            }
                        ?>
                       </p>
                </div>

              </div>

            </div>
    </div>