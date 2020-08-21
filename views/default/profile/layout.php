<?php
/**
 * Profile layout
 * 
 * @uses $vars['entity']  The user
 */
$user = elgg_get_page_owner_entity();
$siteUrl = elgg_get_site_url();
$dbprefix = elgg_get_config('dbprefix');
$grouCount = 0;
$activityCount = 0;
/*
// main profile page
$params = array(
	'content' => elgg_view('profile/wrapper'),
	'num_columns' => 3,
);
echo elgg_view_layout('widgets', $params);
*/

$userGroups = tutor_user_courses($user, $dbprefix);
echo elgg_view('resources/tutor-lms-elements/profile_css');

$profileActivity = tutor_list_river([
	'limit' => 8,
	'pagination' => false,
	'joins' => ["JOIN {$dbprefix}entities e1 ON e1.guid = rv.object_guid"],
	'wheres' => ["(e1.owner_guid = $user->guid)"],
]);
        
        $userActivities = elgg_get_river([
	'limit' => 0,
	'pagination' => false,
	'joins' => ["JOIN {$dbprefix}entities e1 ON e1.guid = rv.object_guid"],
	'wheres' => ["(e1.owner_guid = $user->guid)"],
]);
        
       
        foreach ($userGroups as $v) {
            $grouCount++;
        }
        
        foreach ($userActivities as $c)
        {
            $activityCount++;
            
        }
        
       // var_dump($profileActivity);

?>

<div class="profile-v1" >
             <div class="col-md-12 col-sm-12 profile-v1-wrapper">
                <div class="col-md-9  profile-v1-cover-wrap" style="padding-right:0px;">
                    <div class="profile-v1-pp">
                      <img src="<?php echo $user->getIconURL('medium');?>"/>
                      <h2>
                          <?php
                            echo $user->name;
                          ?>
                      </h2>
                      
                      <?php
                            if($user->role_type != null)
                            {
                        ?>
                      <input type="button" class="btn btn-danger" value="<?php echo ucfirst($user->role_type); ?>" />
                      
                      <?php
                            }
                        ?>
                      
                    </div>
                    <div class="col-md-12 profile-v1-cover">
                      <img src="<?php echo $siteUrl?>mod/tutor-lms/vendors/asset/img/banner.jpg" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 padding-0 profile-v1-right">
                    <div class="col-md-6 col-sm-4 profile-v1-right-wrap padding-0">
                      <div class="col-md-12 padding-0 sub-profile-v1-right text-center sub-profile-v1-right1">
                          <h1><?php echo $grouCount; ?></h1>
                          <p><?php echo elgg_echo('tutor:profile:group-count');?></p>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-4 profile-v1-right-wrap padding-0">
                        <div class="col-md-12 sub-profile-v1-right text-center sub-profile-v1-right2">
                           <h1><?php echo $activityCount;?></h1>
                           <p><?php echo elgg_echo('tutor:profile:posts-count');?></p>
                        </div>
                    </div>
                    
                    </div>
                </div>
             </div>
             <div class="col-md-12 col-sm-12 profile-v1-body">
                <div class="col-md-7">
                   <div class="box-v5 panel" >
                    <div class="panel-heading padding-0 bg-white border-none">
                        <textarea placeholder="what do you think?"></textarea>
                    </div>
                    <div class="panel-body" style="background-color:white;">
                      <div class="col-md-12 padding-0">
                        <div class="col-md-6 col-sm-6 col-xs-6 tool">
                          <a href="#">
                            <span class="fa fa-map-marker fa-2x"></span>
                          </a>
                          <a href="#">
                            <span class="fa fa-camera fa-2x"></span>
                          </a>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 padding-0">
                          <button class="btn btn-round pull-right">
                            <span>SEND</span>
                            <span class="icon-arrow-right icons"></span>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                    
                          <?php 
                     
                          if($profileActivity != null)
                          {
                            echo $profileActivity;
                          }
                          else
                          {
                          ?>
                    
                          <div class="panel box-v7">
                        <div class="panel-body" style="background-color:white;">
                          <div class="col-md-12 padding-0 box-v7-header">
                              <div class="col-md-12 padding-0">
                                  <div class="col-md-10 padding-0">
                                  <img src="<?php echo $user->getIconURL('medium');?>" class="box-v7-avatar pull-left" />
                                  <h4>
                                      <?php
                                        echo $user->name;
                                      ?>
                                  </h4>
                                  
                                  </div>
                                  
                              </div>
                          </div>
                         <div class="col-md-12 padding-10 box-v7-body">
                              <h2>
                                  <?php 
                                    echo elgg_echo('tutor-dashboard:activity:none');
                                  ?>
                              </h2>
                              </br></br>
                          </div>
                          
                        </div>
                    </div>
                        
                          <?php
                          }
                          ?>
                    
                </div>
                <div class="col-md-5">
                     <div class="panel box-v3">
                                <div class="panel-heading bg-white border-none">
                                  <h4>
                                      <?php 
                                        echo elgg_echo('tutor-dashboard:profile:menu');
                                      ?>
                                  </h4>
                                </div>
                                <div class="panel-body">
                                    
                                  <div class="media">
                                     
                                    <div class="media-body">
                                        
                                      
                                      <?php echo elgg_view('profile/owner_block'); ?>
                                    </div>
                                  </div>

                                    
                                </div>
                                <div class="panel-footer bg-white border-none">
                                    
                                </div>
                              </div>
                </div>
                 <div class="col-md-5">
                           <div class="panel box-v3">
                                <div class="panel-heading bg-white border-none">
                                  <h4>
                                      <?php 
                                  
                                            $user->role_type == 'teacher'? $label= elgg_echo('tutor:dashboard:teacher_groups'): $label = elgg_echo('tutor:dashboard:groups'); 
                                          
                                            echo $label;
                                     ?>
                                  </h4>
                                </div>
                                  
                                 <?php
                                   foreach ($userGroups as $v) {
                                       $group = get_entity($v->guid);
                                       
                                   
                                   ?>   
                                <div class="panel-body">
                                  
                                  <div class="media">
                                    <div class="media-left">
                                        <span class="icon-layers icons" style="font-size:2em;"></span>
                                    </div>
                                    <div class="media-body">
                                     <a href="<?php echo $group->getURL();?>">   <h5 class="media-heading"><?php echo $v->name;?></h5></a>
                                        <div class="progress progress-mini">
                                          <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                            <span class="sr-only">60% Complete</span>
                                          </div>
                                        </div>
                                      <h6 class="media-heading"><?php echo $v->briefdescription;?></h6>
                                    </div>
                                  </div>
                                   

                                </div>
                                  </br>
                                   <?php
                                   }
                                    ?>
                                  
                                <div class="panel-footer bg-white border-none">
                                    
                                </div>
                                  
                              </div>
                </div>
             </div>
           
          </div>