<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$group = elgg_extract('entity', $vars);
$owner = $group->getOwnerEntity();

if (elgg_instanceof($group, 'group') && $group->canEdit()) {
	elgg_set_page_owner_guid($group->getGUID());
	elgg_push_breadcrumb($group->name, $group->getURL());
	elgg_push_breadcrumb($title);
	$edit_group = elgg_view("groups/edit", array('entity' => $group));
} else {
	$edit_group = elgg_echo('groups:noaccess');
}

$user = elgg_get_logged_in_user_entity();
	if ($user && $group->isMember($user)) {
		if ($group->owner_guid != $user->guid) {
			// a member can leave a group if he/she doesn't own it
			$actions['groups:leave'] = "action/groups/leave?group_guid={$group->guid}";
		}
	} else if ($user) {
		$url = "action/groups/join?group_guid={$group->guid}";
		if ($group->isPublicMembership() || $group->canEdit()) {
			// admins can always join
			// non-admins can join if membership is public
			$actions['groups:join'] = $url;
		} else {
			// request membership
			$actions['groups:joinrequest'] = $url;
		}
	}
        
        
        $invite = "groups/invite/{$group->guid}";
        $requests = "groups/requests/{$group->guid}";
        
?>
<style>
.panel-body
{background:#f0f3f4;    }
</style>


      <!-- start: Header -->
        
      <!-- end: Header -->

     
  
          <!-- start:Left Menu -->
            
          <!-- end: Left Menu -->


          
            <div class="tabs-wrapper text-center">             
             <div class="panel box-shadow-none text-left content-header">
                  <div class="panel-body" style="padding-bottom:0px;">
                     
                    <ul id="tabs-demo" class="nav nav-tabs content-header-tab" role="tablist" style="padding-top:10px;">
                      <li role="presentation" class="active">
                        <a href="#tabs-area-demo" id="tabs2" data-toggle="tab">Course</a>
                      </li>
                      <?php 
                      if( $group->canEdit())
                      {
                      ?>
                      <li role="presentation" class="">
                        <a href="#panels-area-demo" id="tabs2" data-toggle="tab">Options</a>
                      </li>
                      
                      <li role="presentation" class="">
                        <a href="<?php echo elgg_normalize_url($invite);?>" id="tabs2" >Add users</a>
                      </li>
                      
                      <li role="presentation" class="">
                        <a href="<?php echo elgg_normalize_url($requests);?>" id="tabs2" >Manage requests</a>
                      </li>
                      <?php
                      }
                      ?>
                    </ul>
                  </div>
              </div>
            <div class="col-md-12 tab-content">

              <div role="tabpanel" class="tab-pane fade active in" id="tabs-area-demo" aria-labelledby="tabs1">
                <div class="col-md-12">
                  <div class="col-md-12">
                    <div class="col-md-12 tabs-area">
                      <div class="liner"></div>
                      <ul class="nav nav-tabs nav-tabs-v5" id="tabs-demo6">
                        

                    
                </ul>
                <div class="tab-content tab-content-v5">
                  <div class="tab-pane fade in active" id="tabs-demo6-area3">
                      <center>
<?php 
echo elgg_view_entity_icon($group, 'large', array(
					'href' => '',
					'width' => '18%',
					'height' => '',
				)); 
?>
                          </center>
                    <h3 class="head text-center"><?php echo $group->name;?> </h3>
                    <p class="narrow text-center">
                      <?php 
                      echo $group->briefdescription;
                        
                      ?>
                    </p>

                    <p class="text-center">
                        <a href="<?php echo $owner->getURL()?>" class="btn btn-success btn-round green">
                          <?php
					echo $owner->name;
				?>
                          <span style="margin-left:10px;" class="glyphicon glyphicon-user"></span></a>
                    </p>
                  </div>
                   <?php
                            foreach ($actions as $action => $url) {
		 
                    ?>
                            <div class="col-md-6" style="margin-top:5px;">
                                <a href="<?php echo elgg_add_action_tokens_to_url(elgg_normalize_url($url))?>"> 
                                    <button class="btn ripple btn-outline btn-primary">
                                    <div>
                                      <span>
                                      <?php echo elgg_echo($action);?>
                                      </span>
                                    </div>
                                  </button>
                                    </a>
                              </div>
                        <?php
                        
                        }
                        ?>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>      
              </div>
              <div class="col-md-12">
                  <div class="col-md-12">
                      
                  <div class="col-md-12 tabs-area">

                    <ul id="tabs-demo6" class="nav nav-tabs nav-tabs-v6" role="tablist">
                      <li role="presentation" class="active">
                        <a href="#tabs-demo7-area1" id="tabs-demo6-1" role="tab" data-toggle="tab" aria-expanded="true">About course</a>
                      </li>
                      <!--
                      <li role="presentation" class="">
                        <a href="#tabs-demo7-area2" role="tab" id="tabs-demo6-2" data-toggle="tab" aria-expanded="false">Menu 2</a>
                      </li>
                      <li role="presentation">
                        <a href="#tabs-demo7-area3" id="tabs-demo6-3" role="tab" data-toggle="tab" aria-expanded="false">Menu 3</a>
                      </li>
                      <li role="presentation" class="">
                        <a href="#tabs-demo7-area4" role="tab" id="tabs-demo6-4" data-toggle="tab" aria-expanded="false">Menu 4</a>
                      </li>
                      
                      !-->
                    </ul>
                    <div id="tabsDemo6Content" class="tab-content tab-content-v6 col-md-12">
                      <div role="tabpanel" class="tab-pane fade active in" id="tabs-demo7-area1" aria-labelledby="tabs-demo7-area1">
                          <div class="tutor-single-course-meta tutor-lead-meta">
        <ul>
			                <li>
                    <span>Categories</span>
					<a href="https://demo.themeum.com/plugins/tutor/course-category/marketing/">Marketing</a>                </li>
			
			                <li>
                    <span>Total Hour</span>
                    03h 50m                 </li>
			            <li>
                <span>Total Enrolled</span>
               <?php
                    $num_members = $group->getMembers(array('count' => true));
                    echo elgg_echo('groups:members') . ": " . $num_members;
                ?>
                                    
                                    </li>
            <li>
                <span>Last Update</span>
				April 9, 2019            </li>
        </ul>
    </div>
                        <p>
                        <?php 
                            echo $group->description;
                        
                            
                            
                      ?>
                            
                        </p>
                      </div>
                        <!--
                      <div role="tabpanel" class="tab-pane fade" id="tabs-demo7-area2" aria-labelledby="tabs-demo7-area2">
                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                      </div>
                      <div role="tabpanel" class="tab-pane fade" id="tabs-demo7-area3" aria-labelledby="tabs-demo7-area3">
                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                      </div>
                      <div role="tabpanel" class="tab-pane fade" id="tabs-demo7-area4" aria-labelledby="tabs-demo7-area4">
                        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                      </div>
                        !-->
                    </div>

                  </div>
                  </div>
              </div>
                  
                <div class="col-md-12">
                    <?php
                    if (!$group->isPublicMembership() && !$group->isMember()) {
                        echo elgg_view('groups/profile/closed_membership');
                        
                        }
                        else
                        {
                            echo elgg_view('groups/profile/widgets', $vars); 
                        }
                    ?>
               
                 
                </div>
                 
                </div>
                
                <?php 
                      if( $group->canEdit())
                      {
                ?>
                <div role="tabpanel" class="tab-pane fade" id="panels-area-demo" aria-labelledby="tabs2">
             <div class="col-md-12">
              <div class="col-md-12">
                <div class="col-md-12 tabs-area" >
                     <div class="tab-content tab-content-v5">
                    <div class="tab-pane fade in active" id="tabs-demo6-area3">
                       
                    <h3 class="head text-center"><?php echo $group->name;?> </h3>
                    
 
                    
                    <?php 
                    echo $edit_group;
                    ?>
                  </div>
                         <div class="clearfix"></div>
                </div>
               
                </div>
              </div>
                  </div>
                </div>
                <?php
                      }
                ?>
              </div>
            </div>
          




<!-- custom -->
 
<script type="text/javascript">
  $(document).ready(function(){

    $(".nav-tabs a").click(function (e) {
      e.preventDefault();  
      $(this).tab('show');
    });

  });
</script>
<!-- end: Javascript -->

